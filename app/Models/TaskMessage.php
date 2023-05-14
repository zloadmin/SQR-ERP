<?php

namespace App\Models;

use App\Events\CreateTaskMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskMessage extends Model
{
    use HasFactory;

    protected $guarded = [];


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function (self $message) {
            event(new CreateTaskMessage($message));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->hasOne(Task::class, 'id', 'task_id');
    }

    static function addCreateTask(Task $task)
    {
        self::create([
            'task_id' => $task->id,
            'user_id' => $task->user_id,
            'text'    => 'Card has been created.'
        ]);
    }

    static function addChangeStageTask(Task $task)
    {
        self::create([
            'task_id' => $task->id,
            'user_id' => auth()->check() ? auth()->id() : null,
            'text'    => 'Card stage has been changed.'
        ]);
    }

    static function addCreateFile(TaskFile $file)
    {
        self::create([
            'task_id' => $file->task_id,
            'user_id' => $file->user_id,
            'text'    => $file->getCreateMessage(),
        ]);
    }

    static function addApproveFile(TaskFile $file)
    {
        self::create([
            'task_id' => $file->task_id,
            'user_id' => $file->approved_user_id,
            'text'    => $file->getApproveMessage(),
        ]);
    }

    static function addDeclineFile(TaskFile $file)
    {
        self::create([
            'task_id' => $file->task_id,
            'user_id' => $file->approved_user_id,
            'text'    => $file->getDeclineMessage(),
        ]);
    }

    public function getTelegramRecipients(): array
    {
        $result = [];
        foreach (User::getTelegramUsernames() as $username) {
            if (str_contains($this->text, '@' . $username)) {
                $result[$username] = $username;
            }
        }
        return $result;
    }

    public function getTelegramText()
    {
        $lines = [];

        if ($this->task) {
            $lines[] = 'Customer: ' . $this->task->company_name;
        }
        if ($this->task && $this->user) {
            $lines[] = '_________________';
        }

        if ($this->user) {
            $lines[] = 'From: ' . $this->user->getTelegramSender();
        }

        $lines[] = '';
        $lines[] = '---------------';
        $lines[] = $this->text;
        return implode(PHP_EOL, $lines);
    }
}
