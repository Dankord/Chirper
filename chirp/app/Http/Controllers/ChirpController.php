<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chirp;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChirpController extends Controller
{
    public function index()
    {
        $chirp = Chirp::with('user')->withCount('likedByUsers')->latest()->take(50)->get();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $likedChirpIds = $user ?
            $user
            ->likedChirps()
            ->whereIn('chirp_id', $chirp->pluck('id'))
            ->pluck('chirp_id')
            ->flip()
        : collect();

        return view('home', [
            'chirps' => $chirp,
            'likedChirpIds' => $likedChirpIds,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'message.required' => 'Please write something to chirp!',
            'message.max' => 'Chirps must be 255 characters or less.'
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->chirps()->create($validated);

        return redirect('/')->with('success', 'Chirp Created!');
    }

    public function edit(Chirp $chirp)
    {
        $this->authorize('update', $chirp);
        return view('components.edit', compact('chirp'));
    }

    public function update(Request $request, Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'message.required' => 'Please write something to chirp!',
            'message.max' => 'Chirp must be 255 characters or less'
        ]);

        $chirp->update($validated);

        return redirect('/')->with('success', 'Successfully Updated!');
    }

    public function destroy(Chirp $chirp) {
        $this->authorize('delete', $chirp);

        $chirp->delete();
        return redirect('/')->with('success', 'Successfully Deleted!');
    }

    public function profile(User $user) {
        // The user profile we visit/viewing
        $userChirp = $user->chirps()
            ->with('user')
            ->withCount('likedByUsers')
            ->latest()
            ->get();

        // Current user viewing ther profile
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();

        $likedChirpIds = $currentUser ?
            $currentUser
            ->likedChirps()
            ->whereIn('chirp_id', $userChirp->pluck('id'))
            ->pluck('chirp_id')
            ->flip()
            : collect();

        return view('profile.profile', [
            'user' => $user,
            'chirps' => $userChirp,
            'likedChirpIds' => $likedChirpIds,
            'profile' => $user->profile()->firstOrCreate()
        ]);
    }
}
