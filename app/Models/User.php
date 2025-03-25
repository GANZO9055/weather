<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'password' => 'hashed'
    ];

    protected function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    protected function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }
}
