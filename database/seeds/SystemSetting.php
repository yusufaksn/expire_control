<?php

use Illuminate\Database\Seeder;

class SystemSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('system_setting')->insert([
           'key' => 'expire_limit_day',
           'value' => 5
       ]);
    }
}
