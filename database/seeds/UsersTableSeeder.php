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
            'name' => '宮田大介',
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
            'name' => '森本達也',
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
            'name' => '藤原哲也',
            'zipcode' => '110-0006',
            'address' => '東京都中央区銀座',
            'email' => 'user4@test.com',
            'phone_number' => '08033333333',
            'department_id' => 3,
            'position_id' => 4,
            'is_administrator' => false,
            'password' => Hash::make('1234abc@'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('users')->insert([
            'user_name_id' => 'user4',
            'name' => '村田美咲',
            'zipcode' => '111-0016',
            'address' => '東京都台東区上野',
            'email' => 'user4@test.com',
            'phone_number' => '',
            'department_id' => 5,
            'position_id' => 6,
            'is_administrator' => false,
            'password' => Hash::make('1234abc@'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('users')->insert([
            'user_name_id' => 'user5',
            'name' => '吉岡真由美',
            'zipcode' => '118-0206',
            'address' => '東京都板橋区上板橋',
            'email' => 'user4@test.com',
            'phone_number' => '',
            'department_id' => 3,
            'position_id' => null,
            'is_administrator' => false,
            'password' => Hash::make('1234abc@'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
