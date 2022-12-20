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
        Schema::create('damages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable();
            $table->foreignId('room_id')->nullable();
            $table->foreignId('type_id')->nullable(); // room type id
            $table->foreignId('floor_id')->nullable();
            $table->foreignId('guest_id')->nullable();
            $table->foreignId('asset_id')->nullable();
            $table->string('room_number');
            $table->string('floor_number');
            $table->string('type_name');
            $table->string('amount');
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
        Schema::dropIfExists('damages');
    }
};
