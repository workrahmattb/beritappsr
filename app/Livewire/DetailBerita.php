<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DetailBerita extends Component
{
    public Article $article;

    public function mount(Article $article): void
    {
        abort_if(!$article->isPublished(), 404);

        $this->article = $article->load('author');
    }

    #[Computed]
    public function relatedArticles()
    {
        return Article::with('author')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('id', '!=', $this->article->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.detail-berita')
            ->layout('layouts.blank');
    }
}
