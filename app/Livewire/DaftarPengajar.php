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
        $title = $this->title;
        $description = match ($this->category) {
            'pimpinan' => 'Profil lengkap Pimpinan Pondok Pesantren Syafa\'aturrasul Kuantan Singingi (Ponpes Kuansing) — DR. KH. Hamdani Purba, Lc., MA beserta jajaran pimpinan pondok.',
            'guru'     => 'Daftar tenaga pengajar (guru/ustadz) Pondok Pesantren Syafa\'aturrasul Kuansing. Kenali para pendidik yang mengajar di Ponpes Syafa\'aturrasul.',
            default    => 'Seluruh tenaga pendidik dan pimpinan Pondok Pesantren Syafa\'aturrasul Kuantan Singingi — Ponpes Kuansing.',
        };

        return view('livewire.daftar-pengajar')
            ->layout('layouts.blank', [
                'title'      => $title.' — Ponpes Kuansing',
                'metaDescription' => $description,
                'ogTitle'    => $title.' — Pondok Pesantren Syafa\'aturrasul',
                'ogDescription' => $description,
            ]);
    }
}
