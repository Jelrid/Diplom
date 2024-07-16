<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostGroupSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postGroup = [[
            "group_id"=> 1,
            "name"=> "Администрация",
        ],[
            "group_id"=> 2,
            "name"=> "Врачи МРТ",
        ],[
            "group_id"=> 3,
            "name"=> "Врачи УЗИ",
        ],[
            "group_id"=> 4,
            "name"=> "Врачи КДО",
        ],[
            "group_id"=> 5,
            "name"=> "Рентгенолаборанты",
        ],[
            "group_id"=> 7,
            "name"=> "Регистраторы",
        ],[
            "group_id"=> 9,
            "name"=> "Мед Персонал",
        ],[
            "group_id"=> 13,
            "name"=> "Прочее",
        ],[
            "group_id"=> 15,
            "name"=> "Врачи ФД",
        ],[
            "group_id"=> 16,
            "name"=> "Врачи КТ",
        ],[
            "group_id"=> 17,
            "name"=> "Анализы",
        ]]; 

        DB::table('mskt_post_groups')->insert($postGroup);
    }
}
