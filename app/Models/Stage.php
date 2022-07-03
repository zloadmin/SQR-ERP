<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stage extends Model
{
    const LIST = [
        ['key' => 'account_setup', 'name' => 'Account Setup'],
        ['key' => 'design', 'name' => 'Design'],
        ['key' => 'design_approval', 'name' => 'Design Approval'],
        ['key' => 'content', 'name' => 'Content'],
        ['key' => 'content_approval', 'name' => 'Content Approval'],
        ['key' => 'print_file', 'name' => 'Print File'],
        ['key' => 'production', 'name' => 'Production'],
        ['key' => 'collection', 'name' => 'Collection'],
        ['key' => 'done', 'name' => 'Done'],
    ];
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
