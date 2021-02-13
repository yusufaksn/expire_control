<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;

class Kernel extends ConsoleKernel
{
    public $nowDate;
    public function __construct(Application $app, Dispatcher $events)
    {
        parent::__construct($app, $events);
        $this->nowDate = date('Y-m-d H:i:s');
    }

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
            $this->expireControl();
        })->dailyAt("12:00:00");
    }

    private function expireControl(){
        $data =  DB::table('users')
            ->get([
                'users.expire_date',
                'users.id'
            ]);
        foreach ($data as $value){
            if($this->nowDate > $value->expire_date){
                $this->updateStatus($value->id);
            }
        }
    }
    private function updateStatus($userid){
        if($userid){
            DB::table('users')->where(['id' => $userid])->update(['status' => 0]);
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
