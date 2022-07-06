<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module
{
    const LIST = [
        ['key' => 'stage', 'name' => 'Stage'],
        ['key' => 'order_details_module', 'name' => 'Order Details Module'],
        ['key' => 'delivery_details_module', 'name' => 'Delivery Details Module'],
        ['key' => 'action_module', 'name' => 'Action Module'],
        ['key' => 'sqr_card_module', 'name' => 'SQR CARD Module'],
        ['key' => 'log_module', 'name' => 'Log Module'],
    ];
}
