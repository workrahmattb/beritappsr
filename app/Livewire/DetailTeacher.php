<?php

namespace App\Livewire;

use App\Models\Teacher;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DetailTeacher extends Component
{
    public Teacher $teacher;

    public function mount(Teacher $teacher): void
    {
        $this->teacher = $teacher;
    }

    #[Computed]
    public function relatedTeachers()
    {
        return Teacher::where('category', $this->teacher->category)
            ->where('id', '!=', $this->teacher->id)
            ->orderBy('sort_order')
            ->take(4)
            ->get();
    }

    public function render()
    {
        $backRoute = match ($this->teacher->category) {
            'pimpinan' => route('profile.pimpinan'),
            'guru'     => route('profile.pengajar'),
            default    => url('/'),
        };

        return view('livewire.detail-teacher', [
            'backRoute' => $backRoute,
        ])->layout('layouts.blank', ['title' => $this->teacher->name]);
    }
}
