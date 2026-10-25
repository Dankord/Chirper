<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class ChirpInteractionService
{
    public function getLikedChirpIds(?User $user, iterable $chirpIds): Collection
    {
        if (!$user) {
            return collect();
        }
        return $user->likedChirps()
            ->whereIn('chirp_id', $chirpIds)
            ->pluck('chirp_id')
            ->flip();
    }
}