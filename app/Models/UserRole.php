<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $guarded = [];
    const FIELD_TYPES = [
        'show',
        'edit'
    ];

    static function getAccessFieldNames(): array
    {
        $names = [];
        foreach (Stage::LIST as $stage) {
            foreach (Module::LIST as $module) {
                foreach (self::FIELD_TYPES as $type) {
                    $key = self::getAccessFieldKey($stage, $module, $type);
                    $name = sprintf('Rule for % stage %s in module %s', $type, $stage['name'], $module['key']);
                    $names[$key] = [
                        'stage'  => $stage,
                        'module' => $module,
                        'type'   => $type,
                        'name'   => $name
                    ];
                }
            }
        }
        return $names;
    }

    static function getAccessFieldKey(array $stage, array $module, string $type): string
    {
        return sprintf('%s_%s_%s', $stage['key'], $module['key'], $type);
    }

    static function getAccessFieldShowStageKey(string $stage_key): string
    {
        return sprintf('%s_%s_%s', $stage_key, 'stage', 'show');
    }
    static function getAccessFieldEditStageKey(string $stage_key): string
    {
        return sprintf('%s_%s_%s', $stage_key, 'stage', 'edit');
    }
    static function getAccessFieldShowActionsKey(string $stage_key): string
    {
        return sprintf('%s_%s_%s', $stage_key, 'action_module', 'show');
    }
    static function getAccessFieldShowOrderDetailsKey(string $stage_key): string
    {
        return sprintf('%s_%s_%s', $stage_key, 'order_details_module', 'show');
    }
    static function getAccessFieldEditOrderDetailsKey(string $stage_key): string
    {
        return sprintf('%s_%s_%s', $stage_key, 'order_details_module', 'edit');
    }

    static function getAccessFieldShowDeliveryDetailsKey(string $stage_key): string
    {
        return sprintf('%s_%s_%s', $stage_key, 'delivery_details_module', 'show');
    }
    static function getAccessFieldEditDeliveryDetailsKey(string $stage_key): string
    {
        return sprintf('%s_%s_%s', $stage_key, 'delivery_details_module', 'edit');
    }
    static function getAccessFieldShowSQRCardKey(string $stage_key): string
    {
        return sprintf('%s_%s_%s', $stage_key, 'sqr_card_module', 'show');
    }
    static function getAccessFieldEditSQRCardKey(string $stage_key): string
    {
        return sprintf('%s_%s_%s', $stage_key, 'sqr_card_module', 'edit');
    }

    static function getAccessFieldShowLogKey(string $stage_key): string
    {
        return sprintf('%s_%s_%s', $stage_key, 'log_module', 'show');
    }
    static function getAccessFieldEditLogKey(string $stage_key): string
    {
        return sprintf('%s_%s_%s', $stage_key, 'log_module', 'edit');
    }

    static function getAccessFieldEditActionsKey(string $stage_key): string
    {
        return sprintf('%s_%s_%s', $stage_key, 'action_module', 'edit');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public function getEditTitle(): string
    {
        return sprintf('Edit %s', $this->name);
    }

    public function getEditLink(): string
    {
        return route('settings.user-role.edit', $this);
    }

    public function hasUsers(): bool
    {
        return (bool)$this->users()->count();
    }
}
