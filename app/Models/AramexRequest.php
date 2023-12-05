<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AramexRequest extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'aramex_response' => 'array'
    ];

}
