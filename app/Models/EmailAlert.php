<?php

namespace App\Models;

use App\Traits\HasLinks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAlert extends Model
{
    use HasFactory;
    use HasLinks;
    protected $guarded = [];
    const TYPE_CREATE = 'create';
    const TYPE_CHANGE_STAGE = 'change stage';
    const TYPE_EXPIRED_SLA = 'expired SLA';
    const TYPES = [
        self::TYPE_CREATE,
        self::TYPE_CHANGE_STAGE,
        self::TYPE_EXPIRED_SLA
    ];
    protected $casts = [
        'recipient_user_ids' => 'json'
    ];
}
