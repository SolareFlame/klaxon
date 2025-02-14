<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'desc',
        'pp',
        'pass',
        'perm_level',
        'icetoken',
    ];

    protected $hidden = [
        'pass',
    ];


    public function getKeyType(): string
    {
        return 'string';
    }

    public $incrementing = false;
}
