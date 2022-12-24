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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable();
            $table->foreignId('floor_id')->nullable();
            $table->foreignId('room_id')->nullable();
            $table->foreignId('guest_id')->nullable();
            $table->text('description');
            $table->string('type'); // checked_in_room, food, laundry, load, extension, amenities, beverage, damage
            $table->bigInteger('payable_amount');
            $table->bigInteger('return_amount')->nullable();
            $table->string('given_amount')->nullable(); // paid using cash
            $table->string('from_deposit_amount')->nullable(); // paid using deposit
            $table->string('change_amount')->nullable();
            $table->boolean('change_has_been_deposit')->default(false); // if the guest decided to deposit the change
            $table->dateTime('paid_at')->nullable();
            $table->text('frontdesks'); // json eg. [{"id": 1, "name": "John Doe"}, {"id": 2, "name": "Jane Doe"}]
            $table->boolean('overridden')->default(false); // if the frontdesk decided to override the transaction
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
        Schema::dropIfExists('transactions');
    }
};
