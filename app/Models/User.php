<?php

namespace App\Models;

use App\Traits\HasLinks;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasLinks;


    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [ 'role' ];
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    static function init()
    {
        self::create([
            'name' => 'Test Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin@admin.com'),
            'password_unsafe' => 'admin@admin.com',
            'role_id' => 1
        ]);
    }


    public function role()
    {
        return $this->belongsTo(UserRole::class);
    }

    public function getRoleNameAttribute() : string
    {
        return $this->role->name;
    }


    public function hasRole(string $role): bool
    {
        return $this->role->{$role};
    }

    public function hasRoleSettings(): bool
    {
        return $this->hasRole('settings');
    }
    public function getAccessStagesShowKeys() : array
    {
        $stage_keys = [];
        foreach (Stage::LIST as $stage) {
            $key = UserRole::getAccessFieldShowStageKey($stage['key']);
            if(isset($this->role->{$key}) && $this->role->{$key}) {
                $stage_keys[] = $stage['key'];
            }
        }
        return $stage_keys;
    }
    public function canEditTask(Task $task) : bool
    {
        $key = UserRole::getAccessFieldEditStageKey($task->stage->key);
        return isset($this->role->{$key}) && $this->role->{$key};
    }
    public function canShowActions(Task $task) : bool
    {
        $key = UserRole::getAccessFieldShowActionsKey($task->stage->key);
        return isset($this->role->{$key}) && $this->role->{$key};
    }
    public function canShowOrderDetails(Task $task) : bool
    {
        $key = UserRole::getAccessFieldShowOrderDetailsKey($task->stage->key);
        return isset($this->role->{$key}) && $this->role->{$key};
    }
    public function canShowDeliveryDetails(Task $task) : bool
    {
        $key = UserRole::getAccessFieldShowDeliveryDetailsKey($task->stage->key);
        return isset($this->role->{$key}) && $this->role->{$key};
    }
    public function canEditDeliveryDetails(Task $task) : bool
    {
        $key = UserRole::getAccessFieldEditDeliveryDetailsKey($task->stage->key);
        return isset($this->role->{$key}) && $this->role->{$key};
    }
    public function canShowSQRCard(Task $task) : bool
    {
        $key = UserRole::getAccessFieldShowSQRCardKey($task->stage->key);
        return isset($this->role->{$key}) && $this->role->{$key};
    }
    public function canEditSQRCard(Task $task) : bool
    {
        $key = UserRole::getAccessFieldEditSQRCardKey($task->stage->key);
        return isset($this->role->{$key}) && $this->role->{$key};
    }
    public function canShowLog(Task $task) : bool
    {
        $key = UserRole::getAccessFieldShowLogKey($task->stage->key);
        return isset($this->role->{$key}) && $this->role->{$key};
    }
    public function canEditLog(Task $task) : bool
    {
        $key = UserRole::getAccessFieldEditLogKey($task->stage->key);
        return isset($this->role->{$key}) && $this->role->{$key};
    }
    public function canEditOrderDetails(Task $task) : bool
    {
        $key = UserRole::getAccessFieldEditOrderDetailsKey($task->stage->key);
        return isset($this->role->{$key}) && $this->role->{$key};
    }
    public function canEditActions(Task $task) : bool
    {
        $key = UserRole::getAccessFieldEditActionsKey($task->stage->key);
        return isset($this->role->{$key}) && $this->role->{$key};
    }

}
