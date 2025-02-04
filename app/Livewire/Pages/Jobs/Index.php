<?php


namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use App\Models\JobPost;

class Index extends Component
{
    public function deleteJob($id)
    {
        JobPost::findOrFail($id)->delete();
        session()->flash('successMessage', 'Job post deleted successfully!');
    }

    public function render()
    {
        return view('livewire.pages.jobs.index', [
            'jobs' => JobPost::all(), // Fetch jobs dynamically
        ]);
    }
}
