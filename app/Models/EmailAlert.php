<?php

namespace App\Models;

use App\Traits\HasLinks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class EmailAlert extends Model
{
    use HasFactory;
    use HasLinks;
    use SoftDeletes;

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

    public function emails()
    {
        return $this->hasMany(Email::class, 'email_alert_id', 'id');
    }

    static function createEmailTypeCreate(Task $task)
    {
        $items = self::where('type', self::TYPE_CREATE)
            ->where('stage_id', $task->stage_id)
            ->get();
        self::createEmails($items, $task);
    }

    static function createEmailTypeChangeStage(Task $task)
    {
        $items = self::where('type', self::TYPE_CHANGE_STAGE)
            ->where('stage_id', $task->stage_id)
            ->get();
        self::createEmails($items, $task);
    }

    static function createEmailTypeExpiredSla(Task $task)
    {
        $items = self::where('type', self::TYPE_EXPIRED_SLA)
            ->where('stage_id', $task->stage_id)
            ->get();
        self::createEmails($items, $task);
    }

    static function createEmails(Collection $items, Task $task)
    {
        foreach ($items as $item) {
            $item->emails()->create([
                'recipient' => $item->getRecipient($task),
                'subject' => $item->subject,
                'text' => $item->getText($task),
            ]);
        }
    }

    public function getRecipient(Task $task): string
    {
        if ($this->recipient_id) {
            $user = User::find($this->recipient_id);
            return $user->email ?? '';
        }
        return $task->contact_email ?? '';
    }
    public function getText(Task $task): string
    {
        $text = $this->text;

        foreach ($task->getEmailVariables() as $variable => $value) {
            $text = str_replace($variable, $value, $text);
        }
        return  $text;
    }
}
