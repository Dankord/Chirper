<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chirp;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\ChirpInteractionService;
use App\Services\ChirpSearchService;

class ChirpController extends Controller
{
    public function index(Request $request, ChirpInteractionService $interactionService, ChirpSearchService $searchService)
    {
        // For you
        $forYouChirps = Chirp::with('user')
            ->withCount('likedByUsers')
            ->latest()
            ->take(50)
            ->get();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // following
        $followingChirps = $user
            ? Chirp::whereIn(
                'user_id',
                $user->following()->select('users.id')
            )
            ->with('user')
            ->withCount('likedByUsers')
            ->latest()
            ->take(50)
            ->get()
            : collect();
        // pluck the ids of the chirps
        $chirpIds = $forYouChirps
            ->concat($followingChirps)
            ->pluck('id')
            ->unique();

        $likedChirpIds = $interactionService->getLikedChirpIds($user, $chirpIds);

        $suggestedUsers = $user
            ? User::query()
            ->where('id', '!=', $user->id)
            ->whereNotIn(
                'id',
                $user->following()->select('users.id')
            )
            ->latest()
            ->take(3)
            ->get()
            : collect();

        $search = trim((string) $request->query('search', ''));
        $searchChirps = null;
        $searchUsers = collect();
        $searchLikedChirpsIds = collect();


        if($search != '') {
            $results = $searchService->search($search);

            $searchChirps = $results['chirps'];
            $searchUsers = $results['users'];

            /** @var \App\Models\User $currentUser */
            $currentUser = Auth::user();
            $searchLikedChirpsIds = $interactionService->getLikedChirpIds($currentUser, $searchChirps);
        }

        return view('home', [
            // timeline
            'forYouChirps' => $forYouChirps,
            'followingChirps' => $followingChirps,
            'likedChirpIds' => $likedChirpIds,
            'suggestedUsers' => $suggestedUsers,

            // search
            'search' => $search,
            'searchChirps' => $searchChirps,
            'searchUsers' => $searchUsers,
            'searchLikedChirpsIds' => $searchLikedChirpsIds
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

    public function profile(User $user, ChirpInteractionService $interactionService) {
        // The user profile we visit/viewing
        $user->loadCount(['followers', 'following']);

        $userChirp = $user->chirps()
            ->with('user')
            ->withCount('likedByUsers')
            ->latest()
            ->get();

        // Current user viewing ther profile
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();

        $likedChirpIds = $interactionService->getLikedChirpIds($currentUser, $userChirp->pluck('id'));

        return view('profile.profile', [
            'user' => $user,
            'chirps' => $userChirp,
            'likedChirpIds' => $likedChirpIds,
            'profile' => $user->profile()->firstOrCreate()
        ]);
    }

    public function explore(Request $request, ChirpInteractionService $interactionService, ChirpSearchService $searchService)
    {
        // totla chirp today
        $chirpsToday = Chirp::whereDate('created_at', now())
            ->count();

        // Get chirps that is within 7 days
        $recentChirps = Chirp::where(
            'created_at',
            '>=',
            now()->subDays(7)
        )->get(['id', 'message']);

        //get the trending topics
        $trendingTopics = $recentChirps
            ->flatMap(function($chirp) {
                preg_match_all(
                    '/(?<![\p{L}\p{N}_])#([\p{L}\p{N}_]+)/u',
                    $chirp->message,
                    $matches
                );
                return collect($matches[1])
                    ->map(fn ($tag) => mb_strtolower($tag))
                    ->unique();
            })
            ->countBy()
            ->sortDesc()
            ->map(fn($count, $tag) => [
                'title' => $tag,
                'value' => $count
            ])
            ->values()
            ->take(4);

        // search functionality
        $search = trim((string) $request->query('search', ''));

        $searchChirps = null;
        $searchUsers = collect();
        $likedChirpsIds = collect();

        if ($search !== '') {
            $results = $searchService->search($search);

            $searchChirps = $results['chirps'];
            $searchUsers = $results['users'];

            /** @var \App\Models\User $currentUser */
            $currentUser = Auth::user();

            $likedChirpsIds = $interactionService->getLikedChirpIds($currentUser, $searchChirps->pluck('id'));
        }

        return view('explore.explore', compact(
            'chirpsToday',
            'trendingTopics',
            'search',
            'searchChirps',
            'searchUsers',
            'likedChirpsIds'
        ));
    }
}
