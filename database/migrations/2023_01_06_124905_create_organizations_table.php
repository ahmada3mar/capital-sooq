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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email');
            $table->string('domain')->unique()->index()->nullable();
            $table->string('primary_domain')->unique()->index();
            $table->string('address')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('logo')->nullable();
            $table->string('currency');

            $table->unsignedBigInteger('industry_id');
            $table->foreign('industry_id')
                ->on('industries')
                ->references('id')->onDelete('RESTRICT');

            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')
                ->on('plans')
                ->references('id')->onDelete('RESTRICT');
            $table->timestamp('expired_at')->nullable();

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
        Schema::dropIfExists('organizations');
    }
};
