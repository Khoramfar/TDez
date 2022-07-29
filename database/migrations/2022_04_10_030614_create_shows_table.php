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
        Schema::create('shows', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('theater_id');
            $table->unsignedBigInteger('salon_id');
            $table->unsignedBigInteger('admin_id');


            $table->datetime('show_date');
            $table->boolean('public')->default(false);
            $table->timestamps();

            $table->foreign('theater_id')->references('id')->on('theaters');
            $table->foreign('salon_id')->references('id')->on('salons');
            $table->foreign('admin_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shows');
    }
};
