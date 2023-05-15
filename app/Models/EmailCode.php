<?php

namespace App\Models;

use App\Notifications\AuthCodeNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCode extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function sendCode(User $user) : string
    {
        $code = self::getRandomCode();
        $user->notify(new AuthCodeNotification($code));
        self::addLog($user, $code);
        return $code;
    }

    public static function addLog(User $user, string $code): void
    {
        self::create([
            'user_id' => $user->id,
            'email'   => $user->email,
            'code'    => $code,
        ]);
    }

    static function getRandomCode(): string
    {
        return sprintf('%d%d%d%d%d%d', rand(0, 9), rand(0, 9), rand(0, 9), rand(0, 9), rand(0, 9), rand(0, 9));
    }
}
