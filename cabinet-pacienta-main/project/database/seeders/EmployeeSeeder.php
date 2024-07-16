<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class employeeseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      

        $employeer = [[ 
            'last_name' => 'Олег',
            'first_name' => 'Олегофренович',
            'father_name' => 'Троцкий',
            'sex' => 'male',
            'abbreviated' => null,
            'birth_date' => Carbon::make('2000','01','05'),
            'birth_place' => 'Сольний',
            'citizen' => null,
        ],[
            'last_name' => 'Артем',
            'first_name' => 'Артемович',
            'father_name' => 'Брежнев',
            'sex' => 'male',
            'abbreviated' => null,
            'birth_date' => Carbon::make('2000','02','05'),
            'birth_place' => 'Город',
            'citizen' => null,
        ]];
        DB::table('mskt_employees')->insert($employeer);

    }
}