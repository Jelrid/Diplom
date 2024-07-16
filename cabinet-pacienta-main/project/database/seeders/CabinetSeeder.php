<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class cabinetseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     

       $cabinets = [[
            'filial_id' => 1,
            'number' => 1,
            'name' => 'Кабинет для консультаций',
            'name_shorts' => 'Консул',
            'floor' => '201',
        ],[
            'filial_id' => 1,
            'number' => 2,
            'name' => 'Кабинет не для консультаций',
            'name_shorts' => 'НеКонсул',
            'floor' => '156',
        ]];
        DB::table('mskt_cabinets')->insert($cabinets);
    }
}
