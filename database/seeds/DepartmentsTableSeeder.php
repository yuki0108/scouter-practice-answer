<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => '営業部',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('departments')->insert([
            'name' => '製造部',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('departments')->insert([
            'name' => '経理部',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('departments')->insert([
            'name' => '総務部',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('departments')->insert([
            'name' => '広報部',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('departments')->insert([
            'name' => '人事部',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
