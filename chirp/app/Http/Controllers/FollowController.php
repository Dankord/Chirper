<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    public function toggle(Request $request, User $user) {
        $currentUser = $request->user();

        abort_if($currentUser->is($user), 403);

        $result = $currentUser->following()->toggle($user->id);
        $following = in_array($user->id, $result['attached']);

        return response()->json([
            'following' => $following,
            'follower_count' => $user->followers()->count()
        ]);
    }
}
