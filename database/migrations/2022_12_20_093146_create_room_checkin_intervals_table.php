<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_checkin_intervals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable();
            $table->foreignId('room_id')->nullable();
            $table->unsignedBigInteger('guest_id')->nullable();
            $table->dateTime('last_check_out')->nullable();
            $table->dateTime('check_in_time');
            $table->bigInteger('duration'); // This is the duration of the checkin interval
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
        Schema::dropIfExists('room_checkin_intervals');
    }
};
