<?php

// app/Http/Controllers/JobController.php

namespace App\Http\Controllers;

use App\Models\Jobpost;
use App\Models\Skill;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Jobpost::with('skills')->get(); // Fetch all jobs with skills
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        $skills = Skill::all(); // Fetch all skills
        return view('jobs.create', compact('skills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company_name' => 'required|string',
            'experience' => 'required|string',
            'salary' => 'required|string',
            'location' => 'required|string',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        // Create the jobpost
        $jobpost = Jobpost::create($request->only(['title', 'description', 'company_logo', 'company_name', 'experience', 'salary', 'location']));

        // Attach the selected skills to the jobpost
        if ($request->has('skills')) {
            $jobpost->skills()->attach($request->skills);
        }

        return redirect()->route('jobs.index')->with('success', 'Job created successfully');
    }

    public function edit(Jobpost $jobpost)
    {
        $skills = Skill::all(); // Fetch all skills
        return view('jobs.edit', compact('jobpost', 'skills'));
    }

    public function update(Request $request, Jobpost $jobpost)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company_name' => 'required|string',
            'experience' => 'required|string',
            'salary' => 'required|string',
            'location' => 'required|string',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        // Update the jobpost
        $jobpost->update($request->only(['title', 'description', 'company_logo', 'company_name', 'experience', 'salary', 'location']));

        // Update the skills associated with the jobpost
        if ($request->has('skills')) {
            $jobpost->skills()->sync($request->skills); // Sync to ensure skills are updated
        }

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully');
    }

    public function destroy(Jobpost $jobpost)
    {
        $jobpost->skills()->detach(); // Detach skills before deleting the job
        $jobpost->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully');
    }
}
