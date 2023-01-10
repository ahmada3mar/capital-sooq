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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->float('price');
            $table->float('cost');
            $table->string('image');
            $table->boolean('digital')->default(0);
            $table->boolean('active');
            $table->integer('stock')->default(0);
            $table->enum('status', ['0','1','2' ,'3']);

            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->on('organizations')->references('id');

            $table->unsignedBigInteger('category_');
            $table->foreign('category_')->on('categories')->references('id')->onDelete('RESTRICT');

            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
};
