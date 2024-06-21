<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TaskFile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    const DESIGN_ATTACHMENTS = 'design_attachments';
    const DESIGN_FILE = 'design_file';
    const CARD_DETAILS_ATTACHMENTS = 'card_details_attachments';
    const QR_ATTACHMENTS = 'qr_attachments';
    const PRELOAD_QR_ATTACHMENTS = 'preload_qr_attachments';
    const CONTENT_ATTACHMENTS = 'content_attachments';
    const PRINTING_FILE_ATTACHMENTS = 'printing_file_attachments';
    const DELIVERY_SLIP_ATTACHMENTS = 'delivery_slip_attachments';
    const IMAGE_OF_PRINTED_CARDS_ATTACHMENTS = 'image_of_printed_cards_attachments';
    const ARAMEX_INVOICE = 'aramex_invoice';


    const EXIST_DESIGN_ATTACHMENTS = 'exist_design_attachments';
    const EXIST_CARD_DETAILS_ATTACHMENTS = 'exist_card_details_attachments';
    const EXIST_QR_ATTACHMENTS = 'exist_qr_attachments';

    const EXIST_CONTENT_ATTACHMENTS = 'exist_content_attachments';
    const EXIST_PRINTING_FILE_ATTACHMENTS = 'exist_printing_file_attachments';
    const EXIST_IMAGE_OF_PRINTED_CARDS_ATTACHMENTS = 'exist_image_of_printed_cards_attachments';


    const TYPES = [
        self::DESIGN_ATTACHMENTS,
        self::CARD_DETAILS_ATTACHMENTS,
        self::QR_ATTACHMENTS,
        self::PRELOAD_QR_ATTACHMENTS,

        // not attachments
        self::DESIGN_FILE,
        self::CONTENT_ATTACHMENTS,
        self::PRINTING_FILE_ATTACHMENTS,
        self::DELIVERY_SLIP_ATTACHMENTS,
        self::IMAGE_OF_PRINTED_CARDS_ATTACHMENTS,

        self::ARAMEX_INVOICE

    ];
    const MAIN_FIELDS = [
        self::DESIGN_ATTACHMENTS,
        self::CARD_DETAILS_ATTACHMENTS,
        self::QR_ATTACHMENTS,
    ];
    const ALL_FIELDS = [
        self::DESIGN_ATTACHMENTS,
        self::CARD_DETAILS_ATTACHMENTS,
        self::QR_ATTACHMENTS,
        self::CONTENT_ATTACHMENTS,
        self::PRINTING_FILE_ATTACHMENTS,
        self::IMAGE_OF_PRINTED_CARDS_ATTACHMENTS
    ];
    const EXIST_MAIN_FIELDS = [
        self::EXIST_DESIGN_ATTACHMENTS,
        self::EXIST_CARD_DETAILS_ATTACHMENTS,
        self::EXIST_QR_ATTACHMENTS,
    ];
    const EXIST_ALL_FIELDS = [
        self::EXIST_DESIGN_ATTACHMENTS,
        self::EXIST_CARD_DETAILS_ATTACHMENTS,
        self::EXIST_QR_ATTACHMENTS,
        self::EXIST_CONTENT_ATTACHMENTS,
        self::EXIST_PRINTING_FILE_ATTACHMENTS,
        self::EXIST_IMAGE_OF_PRINTED_CARDS_ATTACHMENTS,
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function (self $task_file) {
            TaskMessage::addCreateFile($task_file);
        });
        static::updated(function (self $task_file) {
            if ($task_file->isApprove()) {
                TaskMessage::addApproveFile($task_file);
            }
            if ($task_file->isDecline()) {
                TaskMessage::addDeclineFile($task_file);
            }
        });
    }

    public function isApprove(): bool
    {
        return $this->approved != $this->getOriginal('approved') && $this->approved == true;
    }

    public function isDecline(): bool
    {
        return $this->approved !== $this->getOriginal('approved') && $this->approved == false;
    }

    public function getClientOriginalName(): string
    {
        return $this->original_name;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getRealPathAttribute(): string
    {
        return Storage::path($this->path);
    }

    public function getUrl()
    {
        return Storage::url($this->path);
    }

    public function getMimeType()
    {
        return mime_content_type($this->real_path);
    }

    public function decline(string $comment = ''): void
    {
        $this->approved = false;
        $this->approved_comment = $comment;
        $this->approved_user_id = auth()->check() ? auth()->id() : null;
        $this->update();
    }

    public function approve(string $comment = ''): void
    {
        $this->approved = true;
        $this->approved_comment = $comment;
        $this->approved_user_id = auth()->check() ? auth()->id() : null;
        $this->update();
    }

    public function getHTMLLink(): string
    {
        return sprintf('<a href="%s" target="_blank">%s</a>', $this->getUrl(), $this->getClientOriginalName());
    }

    public function getTypeText(): string
    {
        return str_replace('_', ' ', str_replace('_attachments', '', $this->type));
    }

    public function getTypeTitle(): string
    {
        return Str::title($this->getTypeText());
    }

    public function getCreateMessage(): string
    {
        return sprintf('Added <b>%s</b> file %s.', $this->getTypeText(), $this->getHTMLLink());
    }

    public function getApproveDeclineComment(): string
    {
        return $this->approved_comment ? sprintf(' Comment <b style="color:red">%s</b>.', $this->approved_comment) : '';
    }

    public function getApproveMessage(): string
    {
        return sprintf('%s file %s has been approved.%s', $this->getTypeTitle(), $this->getHTMLLink(), $this->getApproveDeclineComment());
    }

    public function getDeclineMessage(): string
    {
        return sprintf('%s file %s has been decline.%s', $this->getTypeTitle(), $this->getHTMLLink(), $this->getApproveDeclineComment());
    }

    static function storeUploadFile(Task $task, string $type, UploadedFile $file, bool $is_aramex = false)
    {
        self::create([
            'task_id'       => $task->id,
            'type'          => $type,
            'path'          => $file->store('tasks/' . $type),
            'original_name' => $file->getClientOriginalName(),
            'size'          => $file->getSize(),
            'user_id'       => auth()->check() ? auth()->id() : null,
            'is_aramex' => $is_aramex
        ]);
    }

    static function getUploadSVGFileByUrl(string $url): UploadedFile
    {
        $client = new Client();
        $client->request('GET', $url, [
            'sink' => storage_path('file.log')
        ]);
//        $info = pathinfo($url);
//        $file = '/tmp/' . $info['basename'];
//        file_put_contents($file, file_get_contents($url));
//        return new UploadedFile($file, $info['basename'] . '.svg' );
    }

    static function getPreloadQRAttachmentsFilePath(Task $task)
    {
        return sprintf('%s/%s', self::getPreloadQRAttachmentsPath(), self::getPreloadQRAttachmentsFileName($task));
    }

    static function getPreloadQRAttachmentsFileSize(Task $task): int
    {
        return file_exists(self::getPreloadQRAttachmentsFilePath($task)) ? filesize(self::getPreloadQRAttachmentsFilePath($task)) : 0;
    }

    static function getPreloadQRAttachmentsFileStoragePath(Task $task): string
    {
        return sprintf('tasks/%s/%s', self::PRELOAD_QR_ATTACHMENTS, self::getPreloadQRAttachmentsFileName($task));
    }

    static function getPreloadQRAttachmentsFileName(Task $task): string
    {
        return sprintf('%d.zip', $task->id);
    }

    static function getPreloadQRAttachmentsPath(): string
    {
        return Storage::path('tasks/' . self::PRELOAD_QR_ATTACHMENTS);
    }

    static function getQRAttachmentsPath(): string
    {
        return Storage::path('tasks/' . self::QR_ATTACHMENTS);
    }

    static function savePreloadQRAttachments(Task $task)
    {
        $file = self::firstOrNew([
            'task_id' => $task->id,
            'type'    => self::PRELOAD_QR_ATTACHMENTS,
        ]);

        $file->path = self::getPreloadQRAttachmentsFileStoragePath($task);
        $file->original_name = self::getPreloadQRAttachmentsFileName($task);
        $file->size = self::getPreloadQRAttachmentsFileSize($task);
        $file->save();
    }
    public function changeType(string $type) {
        $this->update(['type' => $type]);
    }
    public function toTelegramMessage()
    {
        return sprintf('File %s. Link: %s.', $this->getClientOriginalName(), $this->getUrl());
    }
}
