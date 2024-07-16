<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ZoneSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
       $zones = [[
            'name' => 'Голова',
            'method_id' =>  1,
        ],[
            'name' => 'Шея',
            'method_id' =>  1, 
        ],[
            'name' => 'Грудная клетка',
            'method_id' =>  1, 
        ],[
            'name' => 'Живот и таз',
            'method_id' =>  1, 
        ],[
            'name' => 'Суставы',
            'method_id' =>  1, 
        ],[
            'name' => 'Позвоночник',
            'method_id' =>  1, 
        ],[
            'name' => 'Общее',
            'method_id' =>  1, 
        ],[
            'name' => 'Конечности',
            'method_id' =>  1, 
        ],[
            'name' => 'Ультразвуковое исследование (УЗИ) с цветным д',
            'method_id' =>  2, 
        ],[
            'name' => 'Общее',
            'method_id' =>  3, 
        ],[
            'name' => 'Общее',
            'method_id' =>  4, 
        ],[
            'name' => 'Комплексное ультразвуковое исследование',
            'method_id' =>  2, 
        ],[
            'name' => 'Дуплексное сканирование (ДС) сосудов',
            'method_id' =>  2, 
        ],[
            'name' => 'Акушерское и/или гинекологической УЗИ',
            'method_id' =>  2, 
        ],[
            'name' => 'ФД',
            'method_id' =>  2, 
        ],[
            'name' => 'Общая',
            'method_id' =>  5, 
        ],[
            'name' => 'Болюсным контрастированием',
            'method_id' =>  5, 
        ],[
            'name' => 'C внутривенным контрастированием',
            'method_id' =>  5, 
        ],[
            'name' => 'Ангиография с внутривенным контрастированием',
            'method_id' =>  1, 
        ],[
            'name' => 'ЭНМГ',
            'method_id' =>  2, 
        ],[
            'name' => 'Забор биоматериала',
            'method_id' =>  6, 
        ],[
            'name' => 'Общеклинические исследования крови',
            'method_id' =>  6, 
        ],[
            'name' => 'Иммуногематология',
            'method_id' =>  6, 
        ],[
            'name' => 'Оценка свертывающей системы',
            'method_id' =>  6, 
        ],[
            'name' => 'Биохимические исследования крови ',
            'method_id' =>  6, 
        ]];
        DB::table('mskt_research_methodology_zones')->insert($zones);
    }
}
