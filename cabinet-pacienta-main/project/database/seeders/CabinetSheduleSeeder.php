<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabinetSheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       $cabinetsSchedule = [[
            'cabinet_id' => 1,
            'date' => NULL,
            'time_start' => '8:00',
            'time_end' => '19:00',
           
        ],[
            'cabinet_id' => 2,
            'date' => NULL,
            'time_start' => '8:00',
            'time_end' => '19:00',
           
        ]];

        DB::table('mskt_cabinet_schedules')->insert($cabinetsSchedule);
    
    }
}
