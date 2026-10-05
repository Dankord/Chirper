<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use App\Models\User;

class Profile extends Model
{

    protected $fillable = [
        'bio',
        'profile_picture',
        'banner',
        'address',
        'occupation'
    ];

    public function user(): belongsTo {
        return $this->belongsTo(User::class);
    }
}
