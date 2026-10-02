<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;

class LikeController extends Controller
{
    public function toggle(Request $request, Chirp $chirp): RedirectResponse {
        $request->user()->likedChirps()->toggle($chirp->id);

        return back();
    }
}
