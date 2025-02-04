<?php

// database/migrations/{timestamp}_create_jobposts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobpostsTable extends Migration
{
    public function up()
    {
        Schema::create('jobposts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('company_logo')->nullable();
            $table->string('company_name');
            $table->string('experience');
            $table->string('salary');
            $table->string('location');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobposts');
    }
}
