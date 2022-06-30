<?php

namespace App\Models;

use App\Events\StageTasksUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'design_attachments'       => 'array',
        'card_details_attachments' => 'array',
        'qr_attachments'           => 'array'
    ];

    const FILES_FIELDS = [
        'design_attachments',
        'card_details_attachments',
        'qr_attachments',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function (Task $task) {
            self::createdStageTasksUpdatedListener($task);
        });
        static::updated(function (Task $task) {
            self::updatedStageTasksUpdatedListener($task);
        });
    }

    public function isChangedStage(): bool
    {
        return $this->stage_id != $this->getOriginal('stage_id');
    }

    static function createdStageTasksUpdatedListener(Task $task)
    {
        event(new StageTasksUpdated($task->stage_id));
    }

    static function updatedStageTasksUpdatedListener(Task $task)
    {
        if ($task->isChangedStage()) {
            event(new StageTasksUpdated($task->getOriginal('stage_id')));
            event(new StageTasksUpdated($task->stage_id));
        }
    }
}
