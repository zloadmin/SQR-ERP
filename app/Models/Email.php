<?php

namespace App\Models;

use App\Mail\SimpleEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Email extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function alert()
    {
        return $this->hasOne(EmailAlert::class, 'id', 'email_alert_id');
    }
    public function send()
    {
        Mail::to($this->recipient)->send(new SimpleEmail($this));
    }
    public function markAsSent()
    {
        $this->update(['sent' => true]);
    }
}
