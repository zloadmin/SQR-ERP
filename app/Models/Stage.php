<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stage extends Model
{
    use HasFactory;
    static function getListNames()
    {
        return self::pluck('name');
    }
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
