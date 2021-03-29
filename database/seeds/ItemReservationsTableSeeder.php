<?php

use Illuminate\Database\Seeder;

class ItemReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_reservations')->insert([
            'item_id' => '1',
            'reservation_id' => '1',
        ]);
        DB::table('item_reservations')->insert([
            'item_id' => '1',
            'reservation_id' => '2',
        ]);
        DB::table('item_reservations')->insert([
            'item_id' => '2',
            'reservation_id' => '2',
        ]);
    }
}
