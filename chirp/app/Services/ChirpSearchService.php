<?php

namespace App\Services;

use App\Models\User;
use app\Models\Chirp;

class ChirpSearchService
{
    public function search(string $term): array
    {
        $chirp = chirp::with('user')
            ->withCount('likedByUsers')
            ->where('message', 'like', "%{$term}%")
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $searchUsers = User::where('name', 'like', "%{$term}%")
            ->take(5)
            ->get();

        return [
            'chirps' => $chirp,
            'users' => $searchUsers
        ];
    }
}