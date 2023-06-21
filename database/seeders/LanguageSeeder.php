<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('languages')->insert([
            'name'       => 'Vietnamese',
            'code'   => 'vi',
            'description'      => 'Viet nam',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('languages')->insert([
            'name'       => 'English',
            'code'   => 'en',
            'description'      => 'English',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
