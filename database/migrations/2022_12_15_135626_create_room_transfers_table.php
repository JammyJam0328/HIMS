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
        Schema::create('room_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id');
            $table->foreignId('guest_id');

            $table->unsignedBigInteger('from_room_id');
            $table->unsignedBigInteger('from_room_type_id');

            $table->unsignedBigInteger('to_room_id');
            $table->unsignedBigInteger('to_room_type_id');

            // static data
            $table->string('from_room_number');
            $table->string('from_room_type');

            $table->string('to_room_number');
            $table->string('to_room_type');

            $table->text('reason')->nullable();
            $table->text('frontdesks');
            $table->unsignedBigInteger('transact_by_admin')->nullable(); // if the admin did the transaction
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
        Schema::dropIfExists('room_transfers');
    }
};
