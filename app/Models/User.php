<?php

namespace App\Models;

use App\Notifications\CustomResetPasswordNotification;
use App\Notifications\SpaResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Send the password reset notification.
     * @param $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new SpaResetPasswordNotification($token));
    }

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function animalsUsers(): HasMany
    {
        return $this->hasMany(AnimalsUser::class);
    }
}
