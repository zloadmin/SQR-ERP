<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TaskFile extends Model
{
    use HasFactory;
    protected $guarded = [];
    const DESIGN_ATTACHMENTS = 'design_attachments';
    const CARD_DETAILS_ATTACHMENTS = 'card_details_attachments';
    const QR_ATTACHMENTS = 'qr_attachments';
    const EXIST_DESIGN_ATTACHMENTS = 'exist_design_attachments';
    const EXIST_CARD_DETAILS_ATTACHMENTS = 'exist_card_details_attachments';
    const EXIST_QR_ATTACHMENTS = 'exist_qr_attachments';
    const TYPES = [
        self::DESIGN_ATTACHMENTS,
        self::CARD_DETAILS_ATTACHMENTS,
        self::QR_ATTACHMENTS,
    ];
    const MAIN_FIELDS = [
        self::DESIGN_ATTACHMENTS,
        self::CARD_DETAILS_ATTACHMENTS,
        self::QR_ATTACHMENTS,
    ];
    const EXIST_MAIN_FIELDS = [
        self::EXIST_DESIGN_ATTACHMENTS,
        self::EXIST_CARD_DETAILS_ATTACHMENTS,
        self::EXIST_QR_ATTACHMENTS,
    ];
    public function getClientOriginalName() : string
    {
        return $this->original_name;
    }
    public function getSize() : int
    {
        return $this->size;
    }

    public function getRealPathAttribute() : string
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
}
