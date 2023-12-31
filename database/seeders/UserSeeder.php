<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'       => 'Super Admin',
            'username'   => 'superadmin',
            'phone'      => '25251325',
            'email'      => 'super_admin@gmail.com',
            'password'   => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        for ($i = 1; $i <= 20; $i++) {
            DB::table('users')->insert([
                'name'       => 'User' . $i,
                'username'   => 'user' . $i,
                'phone'      => '25251325' . $i,
                'email'      => 'user' . $i . '@gmail.com',
                'password'   => Hash::make('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
