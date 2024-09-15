<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, HasRoles, Notifiable;

    protected $fillable = ['name', 'email', 'phone', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getIsAdminAttribute()
    {
        $admins = Cache::remember('admins', 60 * 60, fn () => User::whereHas('roles')->get());

        return in_array($this->id, $admins->pluck('id')->toArray());
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_admin;
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(fn () => Cache::forget('admins'));
    }
}
