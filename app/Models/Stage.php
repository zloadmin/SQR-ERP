<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stage extends Model
{
    const LIST = [
        [ 'id'   => 1,
          'key'  => 'account-setup',
          'name' => 'Account Setup'
        ],
        [ 'id'   => 2,
          'key'  => 'design',
          'name' => 'Design'
        ],
        [ 'id'   => 3,
          'key'  => 'design-approval',
          'name' => 'Design Approval'
        ],
        [ 'id'   => 4,
          'key'  => 'content',
          'name' => 'Content'
        ],
        [ 'id'   => 5,
          'key'  => 'content-approval',
          'name' => 'Content Approval'
        ],
        [ 'id'   => 6,
          'key'  => 'print-file',
          'name' => 'Print File'
        ],
        [ 'id'   => 7,
          'key'  => 'production',
          'name' => 'Production'
        ],
        [ 'id'   => 8,
          'key'  => 'collection',
          'name' => 'Collection'
        ],
        [ 'id'   => 9,
          'key'  => 'done',
          'name' => 'Done'
        ],
    ];
    use HasFactory;

    protected $guarded = [];

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
    static function getListIDs()
    {
        return self::pluck('id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    static function getNextStageId(int $id): int
    {
        return $id + 1 <= self::getLastStageId() ? ++$id : $id;
    }

    static function getPrevStageId(int $id): int
    {
        return $id - 1 >= self::getFirstStageId() ? --$id : $id;
    }

    static function getFirstStageId(): int
    {
        return 1;
    }

    static function getLastStageId(): int
    {
        $result = 1;
        foreach (self::LIST as $stage) {
            if ($stage['id'] > $result) {
                $result = $stage['id'];
            }
        }
        return $result;
    }
}
