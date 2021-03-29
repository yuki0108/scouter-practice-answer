<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 会議室テーブル
        Schema::create('meeting_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('会議室名(必須)');
            $table->integer('max_use_hour')->nullable()->comment('上限利用時間(任意)');
            $table->boolean('needs_approval')->default(false)->comment('承認性フラグ(true:承認制)');
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
        Schema::dropIfExists('meeting_rooms');
    }
}
