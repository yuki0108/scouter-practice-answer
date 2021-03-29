<?php

use Illuminate\Database\Seeder;

class MeetingRoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meeting_rooms')->insert([
            'name' => '会議室A',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('meeting_rooms')->insert([
            'name' => '会議室B (上限3時間)',
            'max_use_hour' => 3,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('meeting_rooms')->insert([
            'name' => '会議室C (承認制)',
            'needs_approval' => true,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
