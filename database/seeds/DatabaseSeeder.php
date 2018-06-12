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
            'active' => true,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('school_levels')->insert([
            'name' => "PRIMARIA",
            'active' => true,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('school_levels')->insert([
            'name' => "SECUNDARIA",
            'active' => true,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('school_levels')->insert([
            'name' => "PREPARATORIA",
            'active' => true,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('periods_types')->insert([
            'name' => "ANUAL",
            'months' => 12,
            'active' => 1,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('periods_types')->insert([
            'name' => "SEMESTRAL",
            'months' => 6,
            'active' => 1,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('periods_types')->insert([
            'name' => "CUATRIMESTRAL",
            'months' => 4,
            'active' => 1,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('school_level_modalities')->insert([
            'school_level_id' => 1,
            'period_type_id' => 1,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('school_level_modalities')->insert([
            'school_level_id' => 2,
            'period_type_id' => 1,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('school_level_modalities')->insert([
            'school_level_id' => 3,
            'period_type_id' => 1,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('school_level_modalities')->insert([
            'school_level_id' => 4,
            'period_type_id' => 2,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

        DB::table('school_level_modalities')->insert([
            'school_level_id' => 4,
            'period_type_id' => 3,
            'created_at' => date_create(),
            'updated_at' => date_create()
        ]);

    }
}
