<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public function getEditTitle(): string
    {
        return sprintf('Edit %s', $this->name);
    }

    public function getEditLink(): string
    {
        return route('settings.user-role.edit', $this);
    }

    public function hasUsers(): bool
    {
        return (bool)$this->users()->count();
    }
}
