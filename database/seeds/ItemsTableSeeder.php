<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'name' => 'プロジェクター',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('items')->insert([
            'name' => 'マイク',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
