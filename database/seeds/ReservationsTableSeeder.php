<?php

use Illuminate\Database\Seeder;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            'reservation_number' => '000001',
            'title' => 'テストA1',
            'user_id' => '2',
            'meeting_room_id' => '1',
            'start_time' => '2021-03-20 10:00:00',
            'end_time' => '2021-03-20 14:00:00',
            'is_approved' => true,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('reservations')->insert([
            'reservation_number' => '000002',
            'title' => 'テストB1',
            'user_id' => '2',
            'meeting_room_id' => '2',
            'start_time' => '2021-04-02 12:00:00',
            'end_time' => '2021-04-02 15:00:00',
            'is_approved' => true,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('reservations')->insert([
            'reservation_number' => '000003',
            'title' => 'テストC1',
            'user_id' => '2',
            'meeting_room_id' => '3',
            'start_time' => '2021-04-03 14:00:00',
            'end_time' => '2021-04-03 15:00:00',
            'is_approved' => true,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('reservations')->insert([
            'reservation_number' => '000004',
            'title' => 'テストC2',
            'user_id' => '2',
            'meeting_room_id' => '3',
            'start_time' => '2021-04-03 16:00:00',
            'end_time' => '2021-04-03 17:00:00',
            'is_approved' => false,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('reservations')->insert([
            'reservation_number' => '000005',
            'title' => 'テストC3',
            'user_id' => '2',
            'meeting_room_id' => '3',
            'start_time' => '2021-04-03 18:00:00',
            'end_time' => '2021-04-03 19:00:00',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('reservations')->insert([
            'reservation_number' => '000006',
            'title' => 'テストC4',
            'user_id' => '3',
            'meeting_room_id' => '1',
            'start_time' => '2021-04-05 18:00:00',
            'end_time' => '2021-04-05 19:00:00',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
