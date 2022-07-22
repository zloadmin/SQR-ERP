<?php

namespace App\Models;

use App\Traits\HasLinks;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SLA extends Model
{
    use HasFactory;
    use HasLinks;

    protected $guarded = [];
    protected $table = 'slas';

    const TYPES = [
        [ 'name' => 'Allowed Type' ]
    ];

    const TIMES = [
        60,
        60 * 5,
        60 * 15,
        60 * 30,
        60 * 45,
        60 * 60
    ];

    static function init()
    {
        foreach (Stage::LIST as $stage) {
            self::create([
                'name'     => 'SLA of stage ' . $stage['name'],
                'type'     => self::getTypesNames('name')[0],
                'stage_id' => $stage['id'],
                'time'     => 60 * 45,
            ]);
        }
    }

    static function getTypesNames()
    {
        return self::getTypesByKey('name');
    }

    static function getTypesByKey($key)
    {
        return array_map(function ($array) use ($key) {
            return $array[$key];
        }, self::TYPES);
    }

    static function getTimes()
    {
        $result = [];
        foreach (self::TIMES as $time) {
            $result[$time] = self::getMinText($time);
        }
        return $result;
    }

    static function getMinText(int $time): string
    {
        $min = intval($time / 60);
        return $min > 1 ? $min . ' minutes' : $min . ' minute';
    }

    public function getTotalTimeTextAttribute(): string
    {
        $result = [];
        if ($this->time_days) {
            $result[] = Carbon::now()->subDays($this->time_days)->longAbsoluteDiffForHumans();
        }
        if ($this->time_hours) {
            $result[] = Carbon::now()->subHours($this->time_hours)->longAbsoluteDiffForHumans();
        }
        if ($this->time_minutes) {
            $result[] = Carbon::now()->subMinutes($this->time_minutes)->longAbsoluteDiffForHumans();
        }

        return implode(" ", $result);
    }

    public function getTimeDaysAttribute(): int
    {
        return $this->time / (60 * 60 * 24);
    }

    public function getTimeHoursAttribute(): int
    {
        return ($this->time % (60 * 60 * 24)) / (60 * 60);
    }

    public function getTimeMinutesAttribute(): int
    {
        return ($this->time % (60 * 60)) / 60;
    }
}
