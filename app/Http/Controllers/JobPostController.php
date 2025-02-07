<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Skill;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobPostController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPost::with('skills'); // Load skills relationship

         // Apply search filter if provided
         if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                  ->orWhere('company_name', 'like', $searchTerm)
                  ->orWhere('description', 'like', $searchTerm)
                  ->orWhereHas('skills', function ($skillQuery) use ($searchTerm) {
                      $skillQuery->where('name', 'like', $searchTerm);
                  });
            });
        }

        // Apply location filter if provided
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Paginate with 4 jobs per page
        $jobs = $query->paginate(4);

        // Pass data to Inertia Dashboard
        return Inertia::render('Dashboard', [
            'jobs' => $jobs,
            'filters' => $request->only('search', 'location')
        ]);
    }
}
