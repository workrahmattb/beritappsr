<?php

namespace App\Livewire;

use App\Models\Teacher;
use Livewire\Component;

class DaftarPengajar extends Component
{
    public ?string $category = null;

    public string $title = '';

    public function mount(): void
    {
        $routeName = request()->route()?->getName();

        $this->category = match ($routeName) {
            'profile.pimpinan' => 'pimpinan',
            'profile.pengajar' => 'guru',
            default            => null,
        };

        $this->title = match ($this->category) {
            'pimpinan' => 'Pimpinan Pondok',
            'guru'     => 'Pengajar',
            default    => 'Seluruh Pengajar',
        };
    }

    public function getTeachersProperty()
    {
        $query = Teacher::orderBy('sort_order');

        if ($this->category) {
            $query->where('category', $this->category);
        }

        return $query->get();
    }

    public function render()
    {
        return view('livewire.daftar-pengajar')
            ->layout('layouts.blank');
    }
}
