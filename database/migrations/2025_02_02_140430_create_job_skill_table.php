<?php

// database/migrations/{timestamp}_create_job_skill_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSkillTable extends Migration
{
    public function up()
    {
        Schema::create('job_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jobpost_id')->constrained('jobposts')->onDelete('cascade');
            $table->foreignId('skill_id')->constrained('skills')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_skill');
    }
}
