<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FillCacheDiffInMinutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'date:fill-diff-in-minutes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = now()->startOfMinute(); $nowStatic = now()->startOfMinute();
        $minutes = 0;
        for ($i = 0;  $i <=  60 * 24 * 7; $i++) {
            $now->subMinute();
            $mins = $now->hour * 60 + $now->minute;
            if(!$now->isWeekday() ||  ($mins >= 600 && $mins <= 1020)) {
                $minutes++;
            }
            \Cache::put(sprintf('%s_%s', $now->toDateTimeString(), $nowStatic->toDateTimeString()), $minutes);
//            dd($now->toDateTimeString(), $nowStatic->toDateTimeString(), $minutes);
//            dd();
        }
        return Command::SUCCESS;
    }
}
