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
        Schema::create('piece_of_furniture', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type_code', 64);
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('room_id');

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

            $table->foreign('type_code')
                ->references('code')
                ->on('piece_of_furniture_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('piece_of_furniture');
    }
};
