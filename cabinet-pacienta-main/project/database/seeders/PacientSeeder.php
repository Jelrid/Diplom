<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;




class PacientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

       $pacients =[[
            'login' => 'login',
            'last_name' => 'Логинов',
            'first_name' => 'Пароль',
            'father_name' => 'Авторизавович',
            'sex' => 'мужской',
            'phone' => null,
            'email' => null,
            'password' => Hash::make('password'),
            'birthday' => Carbon::make('2000','01','05'),
        ],[
            'login' => 'password',
            'last_name' => 'Паролев',
            'first_name' => 'Логин',
            'father_name' => 'Регистравович',
            'sex' => 'мужской',
            'phone' => null,
            'email' => null,
            'password' => Hash::make('login'),
            'birthday' => Carbon::make('2019','01','05'),
        ]];
        DB::table('mskt_pacients')->insert($pacients);
    }
}
