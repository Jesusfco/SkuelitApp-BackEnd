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
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

    }
}
