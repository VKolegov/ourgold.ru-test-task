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
        Schema::create('piece_of_furniture_history_entries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('piece_of_furniture_id');
            $table->timestamp('placed_at');
            $table->timestamp('removed_at')->nullable();
            $table->unsignedBigInteger('apartment_id')->nullable();
            $table->unsignedBigInteger('room_id')->nullable();

            $table->foreign('piece_of_furniture_id')
                ->references('id')
                ->on('piece_of_furniture')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('apartment_id')
                ->references('id')
                ->on('apartments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('piece_of_furniture_history_entries');
    }
};
