<?php

namespace App\Models;

use App\Events\StageTasksUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\TemporaryUploadedFile;

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
    static function getFiles(array $files)
    {
        $result = [];
        foreach ($files as $key => $file) {

//            $result[] =  new TemporaryUploadedFile(Storage::path($file), 'local');
            $result[] =  [
                'source' => $key,
                'options' => [
                    'type' => 'local',
                    'file' => [
                        'name' => $key,
                        'size' => 1,
                        'type' => 'jpeg',
                    ],
                    'metadata' => [
                        'poster' => 'http:ya.ru',
                    ],
                ],
            ];
//            $result[$key] =  new UploadedFile(
//                Storage::path($file),
//                'file',
//                'file',
//                0,
//                0,
//                false
//            );;
        }
//        dd($result);
        return $result;
    }
    public function files()
    {
        return $this->hasMany(TaskFile::class);
    }

    public function getFilesByType(string $type) : Collection
    {
        return $this->files()->where('type', $type)->get();
    }
    public function getDesignAttachments() : Collection
    {
        return $this->getFilesByType(TaskFile::DESIGN_ATTACHMENTS);
    }
    public function getCardDetailsAttachments() : Collection
    {
        return $this->getFilesByType(TaskFile::CARD_DETAILS_ATTACHMENTS);
    }
    public function getQrAttachments() : Collection
    {
        return $this->getFilesByType(TaskFile::QR_ATTACHMENTS);
    }
    public function design_attachments()
    {
        return $this->hasMany(TaskFile::class)->where('type', TaskFile::DESIGN_ATTACHMENTS);
    }
    public function card_details_attachments()
    {
        return $this->hasMany(TaskFile::class)->where('type', TaskFile::CARD_DETAILS_ATTACHMENTS);
    }
    public function qr_attachments()
    {
        return $this->hasMany(TaskFile::class)->where('type', TaskFile::QR_ATTACHMENTS);
    }
}
