<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chirp;

class LikeController extends Controller
{
    public function toggle(Request $request, Chirp $chirp)
    {
        $result = $request->user()->likedChirps()->toggle($chirp->id);

        $liked = in_array($chirp->id, $result['attached']);

        return response()->json([
            'liked' => $liked,
            'count' => $chirp->likedByUsers()->count()
        ]);
    }
}
