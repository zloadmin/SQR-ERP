<?php

namespace App\Models;

use App\Traits\HasLinks;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlaExpiredColor extends Model
{
    use HasFactory;
    use HasLinks;

    protected $guarded = [];

    public function getModelPrefix()
    {
        return 'sla-expired-color';
    }
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
    public function getTimeDaysAttribute(): int
    {
        return $this->time / 24;
    }

    public function getTimeHoursAttribute(): int
    {
        return $this->time % 24;
    }

//    public function getTimeMinutesAttribute(): int
//    {
//        return ($this->time % (60 * 60)) / 60;
//    }
    public function getTotalTimeTextAttribute(): string
    {
        $result = [];
        if ($this->time_days) {
            $result[] = Carbon::now()->subDays($this->time_days)->longAbsoluteDiffForHumans();
        }
        if ($this->time_hours) {
            $result[] = Carbon::now()->subHours($this->time_hours)->longAbsoluteDiffForHumans();
        }


        return implode(" ", $result);
    }
}
