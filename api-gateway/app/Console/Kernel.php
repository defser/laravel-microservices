<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            Log::info(
                sprintf(
                    '[%f] Command started: %s',
                    microtime(true),
                    'CPU FLOODER'
                )
            );

            $count = 10000000;

            $time_start = microtime(true);
            $stringFunctions = array("addslashes", "chunk_split", "metaphone", "strip_tags", "md5", "sha1", "strtoupper", "strtolower", "strrev", "strlen", "soundex", "ord");
            foreach ($stringFunctions as $key => $function) {
                if (!function_exists($function)) unset($stringFunctions[$key]);
            }
            $string = "the quick brown fox jumps over the lazy dog";
            for ($i=0; $i < $count; $i++) {
                foreach ($stringFunctions as $function) {
                    $r = call_user_func_array($function, array($string));
                }
            }
            $number = number_format(microtime(true) - $time_start, 3);

            Log::info(
                sprintf(
                    '[%f] Command ended: %s',
                    microtime(true),
                    'CPU FLOODER'
                )
            );

            return $number;
        })->everyFiveMinutes();

        $schedule->call(function () {
            Log::info(
                sprintf(
                    '[%f] Command started: %s',
                    microtime(true),
                    'CPU FLOODER 2'
                )
            );

            $count = 1000000;

            $time_start = microtime(true);
            $stringFunctions = array("addslashes", "chunk_split", "metaphone", "strip_tags", "md5", "sha1", "strtoupper", "strtolower", "strrev", "strlen", "soundex", "ord");
            foreach ($stringFunctions as $key => $function) {
                if (!function_exists($function)) unset($stringFunctions[$key]);
            }
            $string = "the quick brown fox jumps over the lazy dog";
            for ($i=0; $i < $count; $i++) {
                foreach ($stringFunctions as $function) {
                    $r = call_user_func_array($function, array($string));
                }
            }
            $number = number_format(microtime(true) - $time_start, 3);

            Log::info(
                sprintf(
                    '[%f] Command ended: %s',
                    microtime(true),
                    'CPU FLOODER 2'
                )
            );

            return $number;
        })->everyMinute();
    }
}
