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
        Schema::create('item_attribute_values', function (Blueprint $table) {

            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->on('items')->references('id')->onDelete('CASCADE');

            $table->unsignedBigInteger('attribute_id');
            $table->foreign('attribute_id')->on('attributes')->references('id')->onDelete('CASCADE');

            $table->unsignedBigInteger('value_id');
            $table->foreign('value_id')->on('values')->references('id')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_attribute_values');
    }
};
