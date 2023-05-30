<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 18/03/2019
 * Time: 1:09 AM
 */

namespace App\Traits;
use Illuminate\Support\Str;

trait HasUUID
{
    public static function bootHasUUID()
    {
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
    static function firstByUUID(string $slug)
    {
        return self::uuid($slug)->first();
    }
    static function firstOrFailByUUID(string $slug)
    {
        return self::uuid($slug)->firstOrFail();
    }
    public function scopeUuid($query, $slug)
    {
        $query->where('uuid', $slug);
    }
}
