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
        Schema::create('rent_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // relasi table book categories ke categories
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('book_id');
            // relasi table book categories ke books
            $table->foreign('book_id')->references('id')->on('books');

            $table->date('rent_date');
            $table->date('return_date');
            $table->date('actual_return_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_logs');
    }
};
