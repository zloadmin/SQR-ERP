<?php

namespace App\Models;

use App\Traits\HasLinks;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasLinks;


    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [ 'role' ];
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role()
    {
        return $this->belongsTo(UserRole::class);
    }

    public function getRoleNameAttribute() : string
    {
        return $this->role->name;
    }


    public function hasRole(string $role): bool
    {
        return $this->role->{$role};
    }

    public function hasRoleSettings(): bool
    {
        return $this->hasRole('settings');
    }

}
