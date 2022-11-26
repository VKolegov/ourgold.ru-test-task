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
        Schema::rename('piece_of_furniture', 'pieces_of_furniture');

        Schema::table('pieces_of_furniture', function (Blueprint $table) {
            $table->string('material_code', 64);

            $table->foreign('material_code')
                ->references('code')
                ->on('materials')
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
            $table->dropForeign(['material_code']);

            $table->dropColumn(['material_code']);
        });
        Schema::rename('pieces_of_furniture', 'piece_of_furniture');
    }
};
