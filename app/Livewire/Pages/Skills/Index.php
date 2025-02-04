<?php

namespace App\Livewire\Pages\Skills;

use Livewire\Component;
use App\Models\Skill;

class Index extends Component
{
    public $name;
    public $skillId;
    public $skills;

    public function mount()
    {
        $this->fetchSkills();
    }

    public function fetchSkills()
    {
        $this->skills = Skill::orderBy('created_at', 'desc')->get();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:2|unique:skills,name',
        ]);

        Skill::create(['name' => $this->name]);

        $this->reset('name');
        $this->fetchSkills();
        session()->flash('message', 'Skill added successfully!');
    }

    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        $this->skillId = $skill->id;
        $this->name = $skill->name;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:2|unique:skills,name,' . $this->skillId,
        ]);

        Skill::findOrFail($this->skillId)->update(['name' => $this->name]);

        $this->reset('name', 'skillId');
        $this->fetchSkills();
        session()->flash('message', 'Skill updated successfully!');
    }

    public function delete($id)
    {
        Skill::findOrFail($id)->delete();
        $this->fetchSkills();
        session()->flash('message', 'Skill deleted successfully!');
    }

    public function render()
    {
        return view('livewire.pages.skills.index');
    }
}
