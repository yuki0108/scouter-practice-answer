<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_name_id' => 'user1',
            'name' => 'テスト太郎1',
            'zipcode' => '102-8321',
            'address' => '東京都千代田区北の丸公園２−３',
            'email' => 'user1@test.com',
            'phone_number' => '08011111111',
            'department_id' => 2,
            'position_id' => 1,
            'is_administrator' => true,
            'password' => Hash::make('1234abc@'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('users')->insert([
            'user_name_id' => 'user2',
            'name' => 'テスト太郎2',
            'zipcode' => '110-0006',
            'address' => '東京都台東区秋葉原',
            'email' => 'user2@test.com',
            'phone_number' => '08022222222',
            'department_id' => 5,
            'position_id' => 7,
            'is_administrator' => false,
            'password' => Hash::make('1234abc@'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('users')->insert([
            'user_name_id' => 'user3',
            'name' => 'テスト太郎3',
            'zipcode' => '110-0006',
            'address' => '東京都台東区秋葉原',
            'email' => 'user3@test.com',
            'phone_number' => '08033333333',
            'department_id' => 3,
            'position_id' => 4,
            'is_administrator' => false,
            'password' => Hash::make('1234abc@'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
