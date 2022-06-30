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

    public function getFilesByType(string $type) : array
    {
        $result = [];
        foreach ($this->files()->where('type', $type)->get() as $file) {

            $tmpFile = tmpfile();
//            dd($file);
            $result[$file->id] = new UploadedFile($file->real_path, $file->original_name);
//            $result[] = [
//                'source' => $file->id,
//                'options' => [
//                    'type' => 'local',
//                    'file' => [
//                        'name' => $file->original_name,
//                        'size' => $file->getSize(),
//                        'type' => $file->getMimeType(),
//                    ],
//                    'metadata' => [
//                        'poster' => $file->getUrl(),
//                    ],
//                ],
//            ];;
        }
//        dd($result);
        return  $result;
    }
    public function getDesignAttachmentsAttribute() : array
    {
        return $this->getFilesByType(TaskFile::DESIGN_ATTACHMENTS);
    }
    public function getCardDetailsAttachmentsAttribute() : array
    {
        return $this->getFilesByType(TaskFile::CARD_DETAILS_ATTACHMENTS);
    }
    public function getQrAttachmentsAttribute() : array
    {
        return $this->getFilesByType(TaskFile::QR_ATTACHMENTS);
    }
}
