<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class AllBerita extends Component
{
    use WithPagination;

    public string $search = '';

    #[Computed]
    public function articles()
    {
        return Article::with('author')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('summary', 'like', '%' . $this->search . '%');
            }))
            ->orderBy('published_at', 'desc')
            ->paginate(9);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.all-berita')
            ->layout('layouts.blank');
    }
}
