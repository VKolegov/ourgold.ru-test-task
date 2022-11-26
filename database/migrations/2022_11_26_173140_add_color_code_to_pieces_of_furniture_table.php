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
        Schema::table('pieces_of_furniture', function (Blueprint $table) {
            $table->string('color_code', 64);

            $table->foreign('color_code')
                ->references('code')
                ->on('colors')
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
        Schema::table('pieces_of_furniture', function (Blueprint $table) {
            $table->dropForeign(['color_code']);

            $table->dropColumn(['color_code']);//
        });
    }
};
