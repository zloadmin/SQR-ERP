<?php

namespace App\Models;

use App\Events\StageTasksUpdated;
use App\Events\UpdateTaskStage;
use App\Jobs\EmailAlertChangeStageType;
use App\Jobs\EmailAlertCreateType;
use App\Jobs\EmailAlertExpiredSLA;
use App\Jobs\SendTelegramAlerts;
use App\Jobs\SendWebHook;
use App\Jobs\SendWebHooks;
use App\Jobs\UpdateSQRCardOrderStatus;
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
        'google_attachments'       => 'array',
        'inventory_used'           => 'array',
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

    const MATERIAL_REQUIRED_ERROR = 'You must set "Material" before change stage';
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
            SendTelegramAlerts::dispatch($task);
            $task->updateSQRCardOrderStatus();
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
                SendTelegramAlerts::dispatch($task);
                $task->updateSQRCardOrderStatus();
            }
//            $task->setStageStart();
        });
        static::updating(function (Task $task) {
            $task->setStageStart();
        });
    }

    public function updateSQRCardOrderStatus()
    {
        UpdateSQRCardOrderStatus::dispatch($this);
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

    public function getContentAttachments(): Collection
    {
        return $this->getFilesByType(TaskFile::CONTENT_ATTACHMENTS);
    }

    public function getPrintFileAttachments(): Collection
    {
        return $this->getFilesByType(TaskFile::PRINTING_FILE_ATTACHMENTS);
    }

    public function getImageOfPrintedCardsAttachments(): Collection
    {
        return $this->getFilesByType(TaskFile::IMAGE_OF_PRINTED_CARDS_ATTACHMENTS);
    }

    public function attachments()
    {
        return $this->hasMany(TaskFile::class);
    }

    public function design_attachments()
    {
        return $this->hasMany(TaskFile::class)->where('type', TaskFile::DESIGN_ATTACHMENTS);
    }

    public function image_of_printed_cards_attachments()
    {
        return $this->hasMany(TaskFile::class)->where('type', TaskFile::IMAGE_OF_PRINTED_CARDS_ATTACHMENTS);
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

    public function preload_qr_attachments()
    {
        return $this->hasMany(TaskFile::class)->where('type', TaskFile::PRELOAD_QR_ATTACHMENTS);
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
        return $this->files()->where('type', $type)->latest('updated_at')->first();
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

    public function getLastImageOfPrintedCardsAttachments()
    {
        return $this->getLastFile(TaskFile::IMAGE_OF_PRINTED_CARDS_ATTACHMENTS);
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

    public function getTelegramAlertMessage(TelegramAlert $telegramAlert): string
    {
        $result = $telegramAlert->text;
        foreach (TelegramAlert::VARIABLES as $variable) {
            $variable_text = $this->getTelegramAlertVariableText($variable);
            $result = str_replace('{{' . $variable . '}}', $variable_text, $result);
        }
        return $result;
    }

    public function getTelegramAlertVariableText($variable): string
    {
        $result = '';

        if (isset($this->{$variable})) {
            if ($this->{$variable} instanceof \Illuminate\Database\Eloquent\Collection) {
                foreach ($this->{$variable} as $item) {
                    $result .= $item->toTelegramMessage() . PHP_EOL;
                }
            } elseif ($this->{$variable} instanceof \Illuminate\Database\Eloquent\Model) {
                $result = $this->{$variable}->toTelegramMessage();
            } elseif (is_array($this->{$variable})) {
                $result = implode(PHP_EOL, $this->{$variable});
            } else {
                $result = $this->{$variable};
            }
        }

        return $result;
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
        return sprintf('//%s/secret_login?secret=%s', $this->getSQRCardClientDomain(), urlencode($this->getSQRCardClientLoginSecret()));
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

        return openssl_encrypt($this->getSQRCardClientLoginLoginAndPassword(), 'AES-128-CTR', $this->getSQRCardKey(), 0, substr($this->getSQRCardKey(), 0, 16));
    }

    public function getSQRCardClientLoginLoginAndPassword(): string
    {
        return serialize([
            'username' => $this->sqr_card_username,
            'password' => $this->sqr_card_password,
        ]);
    }


    public function getQrAttachmentsFileNames(): array
    {
        $result = [];
        foreach ($this->getQrAttachments() as $file) {
            if (file_exists($file->real_path)) {
                $result[] = pathinfo($file->real_path, PATHINFO_BASENAME);
            }
        }
        return $result;
    }

    public function getQrAttachmentsFilePaths(): array
    {
        $result = [];
        foreach ($this->getQrAttachments() as $file) {
            if (file_exists($file->real_path)) {
                $result[] = $file->real_path;
            }
        }
        return $result;
    }

    /**
     * Set the user's first name.
     *
     * @param string $value
     * @return void
     */
    public function setWhatsappAttribute($value)
    {
        $this->attributes['whatsapp'] = preg_replace('/\s+/', '', $value);
    }

    public function getGoogleAttachmentsTextAttribute(): string
    {
        return $this->is_google_attachments ? implode(PHP_EOL, $this->google_attachments) : '';
    }

    public function getIsGoogleAttachmentsAttribute(): bool
    {
        return is_array($this->google_attachments) && $this->google_attachments;
    }

}
