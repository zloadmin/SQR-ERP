<?php

namespace App\Models;

use App\Traits\HasLinks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramAlert extends Model
{
    use HasFactory;
    use HasLinks;
    protected $casts = [
        'recipient_ids' => 'json'
    ];
    protected $guarded = [];
    const VARIABLES = [
        'client_link',
        'files',
        'stage',
        'name',
        'company_name',
        'it_is',
        'material',
        'total_cards',
        'instruction',
        'background',
        'design_comments',
        'card_details',
        'contact_name',
        'contact_number',
        'whatsapp',
        'contact_email',
        'delivery_method',
        'emirate',
        'address',
        'sqr_card_username',
        'sqr_card_password',
        'card_collected',
        'delivery_reference',
        'is_api',
        'tag_list'
    ];
    const VARIABLES_INVENTORY = [
        'name',
        'used',
        'available',
        'cumulative'
    ];
    public function getEditLink(): string
    {
        if($this->stage_id) {
            return route('settings.telegram_alert.edit', $this);
        }
        return route('settings.telegram_alert.edit-inventory', $this);
    }
}
