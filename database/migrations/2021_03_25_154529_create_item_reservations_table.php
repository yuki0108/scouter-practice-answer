<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_reservations', function (Blueprint $table) {
            // 備品予約リレーションテーブル
            $table->id();
            $table->foreignId('item_id')->comment('備品ID(必須)');
            $table->foreignId('reservation_id')->comment('予約ID(必須)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_reservations');
    }
}
