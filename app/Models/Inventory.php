<?php

namespace App\Models;

use App\Jobs\SendTelegramInventoryAlerts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function stocks()
    {
        return $this->hasMany(InventoryStock::class);
    }

    public function increaseUsed(int $used)
    {
        $this->update([
            'used' => $this->used + $used
        ]);
        SendTelegramInventoryAlerts::dispatch($this);
    }

    public function getCumulativeAttribute(): int
    {
        return $this->stocks->sum('quantity');
    }

    public function getAvailableAttribute(): int
    {
        return $this->cumulative - $this->used;
    }

    public function getTelegramAlertMessage(TelegramAlert $telegramAlert): string
    {
        $result = $telegramAlert->text;
        foreach (TelegramAlert::VARIABLES_INVENTORY as $variable) {
            $variable_text = $this->{$variable};
            $result = str_replace('{{' . $variable . '}}', $variable_text, $result);
        }
        return $result;
    }

    static function getInventoryUsedTaskArray(array $inventory_used): array
    {
        $result = [];
        foreach ($inventory_used as $inventory_id => $used) {
            $inventory = Inventory::find($inventory_id);
            if ($inventory) {
                $result[$inventory->name] = $used;
            }
        }
        return $result;

    }
}
