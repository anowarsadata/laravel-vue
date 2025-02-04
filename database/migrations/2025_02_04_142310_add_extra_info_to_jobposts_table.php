<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('jobposts', function (Blueprint $table) {
        $table->string('extra_info')->nullable()->after('location'); // Add the column after 'location'
    });
}

public function down()
{
    Schema::table('jobposts', function (Blueprint $table) {
        $table->dropColumn('extra_info');
    });
}

};
