<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MethodSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       

        $methods = [[
            'short_name' => 'МРТ',
            'name' => 'Магнитно-резонансная томография',
        ],[
            'short_name' => 'УЗИ',
            'name' => 'Ультразвуковое исследование',
        ],[
            'short_name' => 'Консультация',
            'name' => 'Консультация',
        ],[
            'short_name' => 'ФД',
            'name' => 'Функциональная диагностика',
        ],[
            'short_name' => 'МСКТ',
            'name' => 'Рентгеновская компьютерная томография',
        ],[
            'short_name' => 'Лаборатория',
            'name' => 'Лабораторная Диагностика',
        ]];

        DB::table('mskt_research_methods')->insert($methods);
    }
}
