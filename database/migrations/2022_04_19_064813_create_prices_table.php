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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salon_id');
            $table->unsignedBigInteger('show_id');
            $table->unsignedBigInteger('section')->nullable(); 
            $table->unsignedBigInteger('cost');
            $table->timestamps();

            $table->foreign('salon_id')->references('id')->on('salons');
            $table->foreign('show_id')->references('id')->on('shows');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
};
