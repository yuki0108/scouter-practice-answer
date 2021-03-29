<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            'name' => '社長',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('positions')->insert([
            'name' => '専務',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('positions')->insert([
            'name' => '部長',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('positions')->insert([
            'name' => '課長',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('positions')->insert([
            'name' => '係長',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('positions')->insert([
            'name' => '主任',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('positions')->insert([
            'name' => '一般',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
