<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 予約テーブル
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_number', 6)->unique()->comment('予約番号(必須, 6桁, 一意)');
            $table->string('title')->nullable()->comment('タイトル(任意)');
            $table->foreignId('user_id')->comment('ユーザーID(必須)');
            $table->foreignId('meeting_room_id')->comment('会議室ID(必須)');
            $table->dateTime('start_time')->comment('使用開始時間(必須)');
            $table->dateTime('end_time')->comment('使用終了時間(必須)');
            // is_approved は承認制会議室を予約した時に false になる
            $table->boolean('is_approved')->nullable()->comment('承認制会議室利用承認済フラグ(true:承認済or承認制会議室でない, false:拒否, null:未承認)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
