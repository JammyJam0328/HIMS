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
            $table->foreignId('room_id')->nullable();
            $table->foreignId('guest_id')->nullable();
            $table->text('description');
            $table->string('type'); // checked_in_room, food, laundry, load, extension, amenities, beverage, damage
            $table->string('payable_amount');
            $table->string('given_amount'); // paid using cash
            $table->string('from_deposit_amount')->nullable(); // paid using deposit
            $table->string('change_amount');
            $table->boolean('change_has_been_deposit')->default(false); // if the guest decided to deposit the change
            $table->dateTime('paid_at');
            $table->text('frontdesks'); // json eg. [{"id": 1, "name": "John Doe"}, {"id": 2, "name": "Jane Doe"}]
            $table->boolean('overridden')->default(false); // if the frontdesk decided to override the transaction
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
