<?php

namespace App\Models;

use App\Events\StageTasksUpdated;
use App\Events\UpdateTaskStage;
use App\Jobs\EmailAlertChangeStageType;
use App\Jobs\EmailAlertCreateType;
use App\Jobs\EmailAlertExpiredSLA;
use App\Jobs\SendWebHook;
use App\Jobs\SendWebHooks;
use App\Traits\HasUUID;
use Carbon\Carbon;
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
    use HasUUID;


    protected $guarded = [];
    protected $casts = [
        'design_attachments'       => 'array',
        'card_details_attachments' => 'array',
        'qr_attachments'           => 'array',
        'tag_list'                 => 'array',
    ];
//    protected $appends = [
//        'tag_list',
//    ];

    const FILES_FIELDS = [
        'design_attachments',
        'card_details_attachments',
        'qr_attachments',
    ];

    const EMAIL_VARIABLE_ACTION_URL = 'action_url';
    const EMAIL_VARIABLE_CARD_CLIENT_NAME = 'card_client_name';
    const EMAIL_VARIABLE_SQR_CARD_USERNAME = 'sqr_card_sqr_username';
    const EMAIL_VARIABLE_SQR_CARD_PASSWORD = 'sqr_card_sqr_password';
    const EMAIL_VARIABLE = [
        self::EMAIL_VARIABLE_ACTION_URL,
        self::EMAIL_VARIABLE_CARD_CLIENT_NAME,
        self::EMAIL_VARIABLE_SQR_CARD_USERNAME,
        self::EMAIL_VARIABLE_SQR_CARD_PASSWORD,
    ];
    const EMAIL_VARIABLE_BLOCK = [
        [
            'key'  => self::EMAIL_VARIABLE_ACTION_URL,
            'text' => 'action url link'
        ],
        [
            'key'  => self::EMAIL_VARIABLE_CARD_CLIENT_NAME,
            'text' => 'name of client of card'
        ],
        [
            'key'  => self::EMAIL_VARIABLE_SQR_CARD_USERNAME,
            'text' => 'sqr card username'
        ],
        [
            'key'  => self::EMAIL_VARIABLE_SQR_CARD_PASSWORD,
            'text' => 'sqr card password'
        ],
    ];

    /**
     * @var mixed|string
     */
    private mixed $username;


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function (Task $task) {
            self::createdStageTasksUpdatedListener($task);
            TaskMessage::addCreateTask($task);
            EmailAlertCreateType::dispatch($task);
            SendWebHooks::dispatch($task);
        });
        static::creating(function (Task $task) {
            $task->setStageStart();
            $task->setDefaultName();
        });
        static::updated(function (Task $task) {
            if ($task->isChangedStage()) {
                self::updatedStageTasksUpdatedListener($task);
                TaskMessage::addChangeStageTask($task);
                EmailAlertChangeStageType::dispatch($task);
                SendWebHooks::dispatch($task);
            }
//            $task->setStageStart();
        });
        static::updating(function (Task $task) {
            $task->setStageStart();
        });
    }

    public function getEmailVariables(): array
    {
        $result = [];
        foreach (self::EMAIL_VARIABLE as $variable) {
            $result['{{' . $variable . '}}'] = $this->getEmailVariable($variable);
        }
        return $result;
    }

    public function getEmailVariable(string $key)
    {
        switch ($key) {
            case self::EMAIL_VARIABLE_ACTION_URL:
                return $this->getSecretActionsLink();
            case self::EMAIL_VARIABLE_CARD_CLIENT_NAME:
                return $this->contact_name;
            case self::EMAIL_VARIABLE_SQR_CARD_USERNAME:
                return $this->sqr_card_username;
            case self::EMAIL_VARIABLE_SQR_CARD_PASSWORD:
                return $this->sqr_card_password;
        }
    }

    public function getStartStageKey(): string
    {
        return Stage::getStartKeyById($this->stage_id);
    }

    public function getExpiredNotifyKey(): string
    {

        return 'expired-notify-stage-' . $this->stage->key;
    }

    public function getStageStart(): Carbon
    {
        return Carbon::parse($this->{$this->getStartStageKey()});
    }

    public function setStageStart()
    {
        $key = $this->getStartStageKey();
        if (is_null($this->{$key})) {
            $this->{$key} = now()->toDateTimeString();
        }
    }

    public function setDefaultName()
    {
        $this->name = $this->name ?? $this->company_name;
    }
//    public function tags()
//    {
//        return $this->hasManyThrough(Tag::class, TaskTag::class, 'task_id', 'id',);
//    }

    /**
     * Get all of the tags for the post.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function sla()
    {
        return $this->hasOne(SLA::class, 'stage_id', 'stage_id');
    }


    public function getTagsIds(): array
    {
        $result = [];
        foreach ($this->tags()->get() as $tag) {
            $result[] = $tag->id;
        }
        return $result;
    }

    public function getTagsNames(): array
    {
        $result = [];
        foreach ($this->tags()->get() as $tag) {
            $result[] = $tag->name;
        }
        return $result;
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
        event(new StageTasksUpdated($task->getOriginal('stage_id')));
        event(new StageTasksUpdated($task->stage_id));
        event(new UpdateTaskStage($task->id));
    }

    static function getFiles(array $files)
    {
        $result = [];
        foreach ($files as $key => $file) {

//            $result[] =  new TemporaryUploadedFile(Storage::path($file), 'local');
            $result[] = [
                'source'  => $key,
                'options' => [
                    'type'     => 'local',
                    'file'     => [
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

    public function getFilesByType(string $type): Collection
    {
        return $this->files()->where('type', $type)->get();
    }

    public function getDesignAttachments(): Collection
    {
        return $this->getFilesByType(TaskFile::DESIGN_ATTACHMENTS);
    }

    public function getCardDetailsAttachments(): Collection
    {
        return $this->getFilesByType(TaskFile::CARD_DETAILS_ATTACHMENTS);
    }

    public function getQrAttachments(): Collection
    {
        return $this->getFilesByType(TaskFile::QR_ATTACHMENTS);
    }

    public function design_attachments()
    {
        return $this->hasMany(TaskFile::class)->where('type', TaskFile::DESIGN_ATTACHMENTS);
    }

    public function design_files()
    {
        return $this->hasMany(TaskFile::class)->where('type', TaskFile::DESIGN_FILE);
    }

    public function card_details_attachments()
    {
        return $this->hasMany(TaskFile::class)->where('type', TaskFile::CARD_DETAILS_ATTACHMENTS);
    }

    public function qr_attachments()
    {
        return $this->hasMany(TaskFile::class)->where('type', TaskFile::QR_ATTACHMENTS);
    }

    public function content_attachments()
    {
        return $this->hasMany(TaskFile::class)->where('type', TaskFile::CONTENT_ATTACHMENTS);
    }

    public function print_file_attachments()
    {
        return $this->hasMany(TaskFile::class)->where('type', TaskFile::PRINTING_FILE_ATTACHMENTS);
    }

    public function messages()
    {
        return $this->hasMany(TaskMessage::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function getNextStageId(): int
    {
        return Stage::getNextStageId($this->stage_id);
    }

    public function getPrevStageId(): int
    {
        return Stage::getPrevStageId($this->stage_id);
    }

    public function getLastFile(string $type)
    {
        return $this->files()->where('type', $type)->latest()->first();
    }

    public function getLastNotApproveFile(string $type)
    {
        return $this->files()->where('type', $type)->where('approved', false)->latest()->first();
    }

    public function getLastQRAttachment()
    {
        return $this->getLastFile(TaskFile::QR_ATTACHMENTS);
    }

    public function getLastDesignAttachment()
    {
        return $this->getLastFile(TaskFile::DESIGN_ATTACHMENTS);
    }

    public function getLastDesignFile()
    {
        return $this->getLastFile(TaskFile::DESIGN_FILE);
    }

    public function getLastContentAttachment()
    {
        return $this->getLastFile(TaskFile::CONTENT_ATTACHMENTS);
    }

    public function getLastPrintFileAttachment()
    {
        return $this->getLastFile(TaskFile::PRINTING_FILE_ATTACHMENTS);
    }

    public function getLastDeliverySlipAttachment()
    {
        return $this->getLastFile(TaskFile::DELIVERY_SLIP_ATTACHMENTS);
    }

    public function getLastNotApproveDesignFile()
    {
        return $this->getLastNotApproveFile(TaskFile::DESIGN_FILE);
    }

    public function getLastNotApproveContentAttachment()
    {
        return $this->getLastNotApproveFile(TaskFile::CONTENT_ATTACHMENTS);
    }

    public function getLastNotApprovePrintFileAttachment()
    {
        return $this->getLastNotApproveFile(TaskFile::PRINTING_FILE_ATTACHMENTS);
    }

    public function getNotApprovedFilesCount($type): int
    {
        return $this->files()->where('type', $type)->where('approved', false)->count();
    }

    public function getRevisions(): int
    {
        switch ($this->stage->key) {
            case('design'):
            case('design-approval'):
                return $this->getNotApprovedFilesCount(TaskFile::DESIGN_FILE);
            case ('content'):
            case ('content-approval'):
                return $this->getNotApprovedFilesCount(TaskFile::CONTENT_ATTACHMENTS);
            default:
                return 0;
        }
    }

    public function getSecretActionsLink(): string
    {
        return route('task-secret.task.edit.action', $this->uuid);
    }

    public function getClientLinkAttribute(): string
    {
        return $this->getSecretActionsLink();
    }

    public function setExpiredSLA()
    {
        $this->{$this->getExpiredNotifyKey()} = true;
        $this->update();
        EmailAlertExpiredSLA::dispatch($this);
    }

    static function createAPI(array $data)
    {
        $data['is_api'] = true;
        return self::create($data);
    }

    public function getWebHookData(WebHook $webHook): array
    {
        $data = [];
        foreach ($webHook->variables as $variable) {
            if (isset($this->{$variable})) {
                if ($this->{$variable} instanceof \Illuminate\Database\Eloquent\Collection) {
                    $data[$variable] = $this->{$variable}->toArray();
                } else {
                    $data[$variable] = $this->{$variable};
                }
            }
        }
        return $data;
    }

    public function getTagListAttribute(): array
    {
        return self::getTagsNames();
    }

    public function deleteFull()
    {
        $this->files()->forceDelete();
        $this->messages()->delete();
        $this->delete();
    }

    public function isApi(): bool
    {
        return (bool)$this->is_api;
    }

    public function isSendWebHook(): bool
    {
        return true;
        return !$this->isApi();
    }

    public function getCurrentSLATimeLeft()
    {
        return $this->getStageStart()->longAbsoluteDiffForHumans(now());
    }

    public function getTimeLeft()
    {
        return $this->created_at->longAbsoluteDiffForHumans(now());
    }

    public function getSQRCardClientLoginLink(): string
    {
        return sprintf('https://%s/login/%s', $this->getSQRCardClientDomain(), $this->getSQRCardClientLoginSecret());
    }
    private function getSQRCardKey()
    {
        return config('services.sqrcard.key');
    }
    private function getSQRCardClientDomain()
    {
        return config('services.sqrcard.client_domain');
    }
    public function getSQRCardClientLoginSecret(): string
    {
        return openssl_encrypt($this->getSQRCardClientLoginLoginAndPassword(), 'AES-128-CTR', $this->getSQRCardKey());
    }

    public function getSQRCardClientLoginLoginAndPassword(): string
    {
        return sprintf('%s;%s', $this->sqr_card_username, $this->sqr_card_password);
    }

}
