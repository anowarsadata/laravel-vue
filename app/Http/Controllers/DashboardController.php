<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $jobs = JobPost::with('skills')->latest()->get();

        return Inertia::render('Dashboard', [
            'jobs' => $jobs
        ]);
    }
}
