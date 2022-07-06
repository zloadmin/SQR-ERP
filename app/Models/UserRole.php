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

    static function getAccessFieldStageShowKey(string $stage_key): string
    {
        return sprintf('%s_%s_%s', $stage_key, 'stage', 'show');
    }
    static function getAccessFieldStageEditKey(string $stage_key): string
    {
        return sprintf('%s_%s_%s', $stage_key, 'stage', 'edit');
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
