<?php

// app/Models/JobPost.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $table = 'jobposts'; // Correct table name

    protected $fillable = [
        'title', 'description', 'experience', 'salary', 'location', 'extra_info',
        'company_name', 'company_logo', 'skills'
    ];
    

    public function skills()
    {
        // Use 'jobpost_id' as the foreign key for this relation
        return $this->belongsToMany(Skill::class, 'job_skill', 'jobpost_id', 'skill_id');
    }
}
