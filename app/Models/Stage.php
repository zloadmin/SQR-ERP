<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    const LIST = [
        ['name' => 'Account Setup'],
        ['name' => 'Design'],
        ['name' => 'Design Approval'],
        ['name' => 'Content'],
        ['name' => 'Content Approval'],
        ['name' => 'Print File'],
        ['name' => 'Production'],
        ['name' => 'Collection'],
        ['name' => 'Done'],
    ];
    static function getListNames()
    {
        return self::getListByKey('name');
    }

    static function getListByKey($key)
    {
        return array_map(function ($array) use ($key) {
            return $array[$key];
        }, self::LIST);
    }
}
