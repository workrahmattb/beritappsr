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
        $teacher = $this->teacher;
        $bio = $teacher->bio ? strip_tags($teacher->bio) : '';
        $description = $bio 
            ? mb_substr($bio, 0, 160) 
            : $teacher->name.', '.$teacher->categoryLabel().' di Pondok Pesantren Syafa\'aturrasul Kuantan Singingi (Ponpes Kuansing).';
        $ogImage = $teacher->photo ? asset('storage/'.$teacher->photo) : asset('gambar/ppsr logo.webp');

        $backRoute = match ($teacher->category) {
            'pimpinan' => route('profile.pimpinan'),
            'guru'     => route('profile.pengajar'),
            default    => url('/'),
        };

        $detailRoute = match ($teacher->category) {
            'pimpinan' => route('profile.pimpinan.detail', $teacher->slug),
            'guru'     => route('profile.pengajar.detail', $teacher->slug),
            default    => url('/'),
        };

        return view('livewire.detail-teacher', [
            'backRoute' => $backRoute,
        ])->layout('layouts.blank', [
            'title'      => $teacher->name.' — '.$teacher->categoryLabel().' Ponpes Kuansing',
            'metaDescription' => $description,
            'ogTitle'    => $teacher->name.' — '.$teacher->categoryLabel().' Pondok Pesantren Syafa\'aturrasul',
            'ogDescription' => $description,
            'ogImage'    => $ogImage,
            'canonicalUrl' => $detailRoute,
        ]);
    }
}
