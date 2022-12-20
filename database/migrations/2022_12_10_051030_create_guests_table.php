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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable();
            $table->string('qr_code')->unique();
            $table->string('name');
            $table->string('contact_number');
            //
            $table->foreignId('room_id')->nullable();
            $table->foreignId('type_id')->nullable();
            $table->foreignId('floor_id')->nullable();
            $table->foreignId('staying_hour_id')->nullable();
            $table->foreignId('rate_id')->nullable();
            //

            $table->string('room_number')->nullable();

            //
            $table->dateTime('checkin_at')->nullable();
            $table->dateTime('checkout_at')->nullable();
            //
            //
            $table->string('status')->default('in_queue'); // in_queue, checked_in, checked_out, terminated
            $table->string('type')->default('walk_in'); // walk_in, reservation
            //
            //
            $table->integer('total_deposits')->default(0);
            //
            //
            $table->boolean('is_long_stay')->nullable();
            $table->integer('long_stay_number_of_days')->nullable();
            $table->integer('staying_hours')->nullable();
            $table->integer('check_in_amount')->nullable();
            $table->integer('extended_hours')->nullable();
            $table->dateTime('expected_checkout_at')->nullable();
            //
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
        Schema::dropIfExists('guests');
    }
};
