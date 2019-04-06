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

            $count = 5000000;

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
        })->everyFiveMinutes()->name('cpu-flooder-first')->withoutOverlapping();

        $schedule->call(function () {
            Log::info(
                sprintf(
                    '[%f] Command started: %s',
                    microtime(true),
                    'CPU FLOODER 2'
                )
            );

            $count = 100000;

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
        })->everyMinute()->name('cpu-flooder-second')->withoutOverlapping();

        $schedule->call(function () {
            Log::info(
                sprintf(
                    '[%f] Command started: %s',
                    microtime(true),
                    'MEMORY FLOODER'
                )
            );

            $x = str_repeat(
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sollicitudin turpis ut augue lacinia at ullamcorper dolor condimentum. Nunc elementum suscipit laoreet. Phasellus vel sem justo, a vulputate arcu. Sed rutrum elit nec elit lobortis ultrices. Quisque elit nulla, rutrum et varius sit amet, pulvinar eget purus. Aliquam erat volutpat. Fusce turpis lectus, vestibulum sed ornare sed, facilisis sit amet lacus. Nunc lobortis posuere ultricies. Phasellus aliquet cursus gravida. Curabitur eu erat ac augue rutrum mattis. Suspendisse sit amet urna nec velit commodo feugiat. Maecenas vulputate dictum diam, eu tempor erat volutpat in. Donec id nulla tortor, nec iaculis nibh. Pellentesque scelerisque nisl sit amet ligula dictum commodo. Donec porta mi in lorem porttitor id suscipit lacus auctor.',
                225000
            );

            Log::info(
                sprintf(
                    '[%f] Command ended: %s',
                    microtime(true),
                    'MEMORY FLOODER'
                )
            );
        })->everyTenMinutes()->name('ram-flooder-first')->withoutOverlapping();
    }
}
