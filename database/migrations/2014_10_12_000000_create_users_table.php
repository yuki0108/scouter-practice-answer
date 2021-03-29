<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('氏名(必須)');
            $table->string('zipcode')->comment('郵便番号(必須、ハイフンあり)');
            $table->string('address')->comment('住所(必須)');
            $table->string('email')->nullable()->comment('E-mail(任意)');
            $table->string('phone_number')->nullable()->comment('携帯電話(任意)');
            $table->foreignId('department_id')->default(1)->comment('所属部署のID(必須)');
            $table->foreignId('position_id')->nullable()->comment('役職ID(任意)');
            $table->boolean('is_administrator')->default(false)->comment('管理者フラグ(true:管理者)');

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
