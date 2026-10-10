<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function update(Request $request, User $user)
    {
        abort_unless($request->user()->is($user), 403);

        $validated = $request->validate([
            'bio' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255'
        ]);

        $profile = $user->profile()->firstOrCreate([]);

        $profile->update($validated);

        return redirect()->route('profile', $user)->with('status', 'Profile updated sucessfully');
    }
}
