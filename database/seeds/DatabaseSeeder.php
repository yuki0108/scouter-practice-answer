<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(DepartmentsTableSeeder::class);
         $this->call(PositionsTableSeeder::class);
         $this->call(MeetingRoomsTableSeeder::class);
         $this->call(ItemsTableSeeder::class);
         $this->call(ReservationsTableSeeder::class);
         $this->call(ItemReservationsTableSeeder::class);
         $this->call(UsersTableSeeder::class);
    }
}
