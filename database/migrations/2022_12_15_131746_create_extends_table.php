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
        Schema::create('extends', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable();
            $table->foreignId('room_id')->nullable();
            $table->foreignId('type_id')->nullable(); // room type id
            $table->foreignId('floor_id')->nullable();
            $table->foreignId('guest_id')->nullable();
            $table->unsignedBigInteger('extension_rate_id');
            $table->string('room_number');
            $table->string('floor_number');
            $table->string('type_name');
            $table->string('hours');
            $table->string('total_hours'); // total hours of extension and the check-in hours
            $table->string('amount');
            $table->string('front_desk_names')->nullable();
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
        Schema::dropIfExists('extends');
    }
};
