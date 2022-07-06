<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function alert()
    {
        return $this->hasOne(EmailAlert::class, 'id', 'email_alert_id');
    }
}
