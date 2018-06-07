<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => "JESUS FCO ",
            'patern_surname' => "CORTES",
            'matern_surname' => "RODRIGUEZ",
            'CURP' => 'CORJ48845ASDF548CB007',
            'email' => 'jfcr@live.com',
            'password' => bcrypt('secret'),
            'user_type' =>  5,
            'status' =>  1,
            'gender' =>  1,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('school_levels')->insert([
            'name' => "KINDER",
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('school_levels')->insert([
            'name' => "PRIMARIA",
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('school_levels')->insert([
            'name' => "SECUNDARIA",
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('school_levels')->insert([
            'name' => "PREPARATORIA",
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

    }
}
