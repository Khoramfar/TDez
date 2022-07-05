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
        Schema::table('theaters', function (Blueprint $table) {
            $table->string('cover_file_name')->nullable()->after('description');
            $table->string('original_cover_file_name')->nullable()->after('cover_file_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('theaters', function (Blueprint $table) {
            $table->dropColumn('cover_file_name');
            $table->dropColumn('original_cover_file_name');
        });
    }
};
