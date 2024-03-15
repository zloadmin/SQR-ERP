<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Stage extends Model
{
    // You need refresh migration after change and after add to DB.
    const LIST = [
        [
            'id'    => 1,
            'key'   => 'account-setup',
            'name'  => 'Account Setup',
            'order' => 1,
        ],
        [
            'id'    => 11,
            'key'   => 'rm-support',
            'name'  => 'RM Support',
            'order' => 2,
        ],
        [
            'id'    => 2,
            'key'   => 'design',
            'name'  => 'Design',
            'order' => 3,
        ],
        [
            'id'    => 3,
            'key'   => 'design-approval',
            'name'  => 'Design Approval',
            'order' => 4,
        ],
        [
            'id'    => 4,
            'key'   => 'content',
            'name'  => 'Content',
            'order' => 5,
        ],
        [
            'id'    => 5,
            'key'   => 'content-approval',
            'name'  => 'Content Approval',
            'order' => 6,
        ],
        [
            'id'    => 6,
            'key'   => 'print-file',
            'name'  => 'Print File',
            'order' => 7,
        ],
        [
            'id'    => 10,
            'key'   => 'qa',
            'name'  => 'QA',
            'order' => 8,
        ],
        [
            'id'    => 7,
            'key'   => 'production',
            'name'  => 'Production',
            'order' => 9,
        ],
        [
            'id'    => 8,
            'key'   => 'collection',
            'name'  => 'Collection',
            'order' => 10,
        ],
        [
            'id'    => 9,
            'key'   => 'done',
            'name'  => 'Done',
            'order' => 11,
        ],
    ];
    use HasFactory;

    protected $guarded = [];
//    const STAGE_CREATED  = 10000;
//    const SPECIFIC_STAGES = [
//        self::STAGE_CREATED
//    ];
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('ordering', function (Builder $builder) {
            $builder->orderBy('order');
        });
    }

    static function init()
    {
        foreach (self::LIST as $stage) {
            self::create($stage);
        }
    }

    static function getListNames()
    {
        return self::pluck('name');
    }

//    static function getListIDs()
//    {
//        return self::pluck('id');
//    }
//
//    static function getListIDsArray() : array
//    {
//        return self::getListIDs()->toArray();
//    }
    static function getAllStageIds(): array
    {
        return array_merge(self::getListIDsArray(), self::SPECIFIC_STAGES);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    static function getArrayIDS()
    {
        return self::pluck('id')->toArray();
    }

    static function getNextStageId(int $id): int
    {
        $order = self::find($id)->order;
        $next = self::where('order', '=', $order + 1)->first();
        return $next ? $next->id : self::getLastStageId();
    }

    static function getPrevStageId(int $id): int
    {
        if ($id == 4) return 1;

        $order = self::find($id)->order;
        $prev = self::where('order', '=', $order - 1)->first();
        return $prev ? $prev->id : self::getPrevStageId();
    }

    static function getFirstStageId(): int
    {
        return self::query()->first()->id;
    }

    static function getLastStageId(): int
    {
        return self::query()->orderByDesc('order')->first()->id;
    }

    static function getStageById(int $id): array
    {
        foreach (self::LIST as $stage) {
            if ($stage['id'] === $id) {
                return $stage;
            }
        }

    }

    static function getStartKeyById(int $id)
    {
        return 'start-stage-' . self::getStageById($id)['key'];
    }

    static function getUpdateKeyById(int $id)
    {
        return 'update-stage-' . self::getStageById($id)['key'];
    }

    public function toTelegramMessage()
    {
        return $this->name;
    }
}
