<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class filialseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       

        DB::table('mskt_filials')->insert([
            'kkm_address' => null,
            'order' => 1,
            'name' => 'Техаский',
            'address' => 'Техас 23',
        ]);
    }
}
