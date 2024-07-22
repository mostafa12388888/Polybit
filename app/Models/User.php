<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function canAccessPanel(): bool
    {
        return $this->is_admin;
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function (self $user) {
            if ($user->isDirty('is_admin') && ! $user->is_admin) {
                if (User::where('is_admin', true)->count() == 1) {
                    \Filament\Notifications\Notification::make()->title('There must be at least one admin!')->danger()->send();
                    $user->is_admin = true;
                }
            }
        });
    }
}
