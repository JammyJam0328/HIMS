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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('floor_id')->nullable();
            $table->integer('number');
            $table->string('status')->default('available');
            $table->foreignId('type_id')->nullable();
            $table->boolean('is_priority')->default(true);
            $table->dateTime('last_checkin_at')->nullable();
            $table->dateTime('last_checkout_at')->nullable();
            $table->dateTime('time_to_terminate_in_queue')->nullable();
            $table->dateTime('check_out_time')->nullable();



            $table->dateTime('time_to_clean')->nullable();
            $table->dateTime('started_cleaning_at')->nullable();
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
        Schema::dropIfExists('rooms');
    }
};
