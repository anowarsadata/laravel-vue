<?php

// app/Models/Skill.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Define many-to-many relationship with job posts
    public function jobPosts()
    {
        return $this->belongsToMany(JobPost::class, 'job_skill', 'skill_id', 'jobpost_id');
    }
}
