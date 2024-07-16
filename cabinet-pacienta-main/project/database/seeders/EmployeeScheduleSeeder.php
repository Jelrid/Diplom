<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmployeeScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
   

        $F_id = DB::table('mskt_employees')->pluck('id')->first();
        $FCS_id = DB::table('mskt_cabinet_schedules')->pluck('id')->first();
        

        DB::table('mskt_employee_schedules')->insert([
            'shift' => null,
            'employee_id' => $F_id,
            'cabinet_schedule_id' => $FCS_id,
            'time_start' => '7:00',
            'time_end' => '16:00',
            'remote' => null,
            'can_get_pay' => null,
            'methodology_id' => null,
            'check_employee_id' => null,
            'post_id' => null,
            'timed_replace' => null,
            'timed_replace_employee_id' => null,
            'time_stimed_replace_timetart' => null,
           
        ]);
    }
}
