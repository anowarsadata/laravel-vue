<?php
namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\JobPost;
use App\Models\Skill;

class Create extends Component
{
    use WithFileUploads;

    public $title, $description, $experience, $salary, $location, $extra_info;
    public $company_name, $company_logo, $selectedSkills = [];
    public $successMessage = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'experience' => 'required|string|max:50',
        'salary' => 'required|string|max:50',
        'location' => 'required|string|max:255',
        'extra_info' => 'nullable|string',
        'company_name' => 'required|string|max:255',
        'company_logo' => 'nullable|image|max:2048',
        'selectedSkills' => 'required|array',
    ];

    public function saveJobPost()
    {
        $this->validate();

        // Store company logo if uploaded
        $logoPath = $this->company_logo ? $this->company_logo->store('company_logos', 'public') : null;

        // Save job post
        $job = JobPost::create([
            'title' => $this->title,
            'description' => $this->description,
            'experience' => $this->experience,
            'salary' => $this->salary,
            'location' => $this->location,
            'extra_info' => $this->extra_info,
            'company_name' => $this->company_name,
            'company_logo' => $logoPath,
        ]);

        // Attach selected skills
        $job->skills()->attach($this->selectedSkills);

        // Reset form
        $this->reset(['title', 'description', 'experience', 'salary', 'location', 'extra_info', 'company_name', 'company_logo', 'selectedSkills']);

        // Show success message
        $this->successMessage = 'Job posted successfully!';
    }

    public function render()
    {
        return view('livewire.pages.jobs.create', [
            'skills' => Skill::all(),
        ]);
    }
}
