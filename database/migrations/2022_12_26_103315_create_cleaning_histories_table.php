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
        Schema::create('cleaning_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('room_id');
            $table->foreignId('floor_id');
            $table->foreignId('current_assigned_floor_id');
            
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->dateTime('expected_end_time');
            $table->integer('cleaning_duration');
            $table->boolean('delayed_cleaning')->default(false);
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
        Schema::dropIfExists('cleaning_histories');
    }
};
