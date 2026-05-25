<?php

namespace App\Livewire\Admin;

use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Kelola Berita')]
class AdminBerita extends Component
{
    use WithFileUploads;

    public string $search = '';
    public string $statusFilter = 'all';
    public string $pageTitle = 'Buat Berita Baru';

    // Basic Info
    public string $title = '';
    public string $slug = '';
    public string $summary = '';

    // Content
    public string $content = '';

    // Media
    public string $status = 'draft';
    public ?string $image = null;

    // Schedule
    public ?string $scheduledAt = null;

    // SEO
    public ?string $metaTitle = null;
    public ?string $metaDescription = null;
    public ?string $ogImage = null;
    public ?string $focusKeyword = null;

    // Form State
    public bool $showForm = false;
    public bool $showBasic = true;
    public bool $showMedia = false;
    public bool $showStatus = false;
    public bool $showSeo = false;
    public ?int $editingId = null;

    public function mount(): void
    {
        if ($this->editingId) {
            $this->loadArticle($this->editingId);
        }
    }

    public function toggleSection(string $section): void
    {
        $sections = ['showBasic', 'showMedia', 'showStatus', 'showSeo'];
        foreach ($sections as $s) {
            if ($s === $section) {
                $this->$s = !$this->$s;
            }
        }
    }

    public function toggleForm(): void
    {
        $this->showForm = !$this->showForm;
        if (!$this->showForm) {
            $this->resetForm();
            $this->showBasic = true;
            $this->showMedia = false;
            $this->showStatus = false;
            $this->showSeo = false;
        }
    }

    public function resetForm(): void
    {
        $this->reset(['title', 'slug', 'content', 'summary', 'status', 'image', 'scheduledAt', 'metaTitle', 'metaDescription', 'ogImage', 'focusKeyword', 'editingId']);
        $this->status = 'draft';
        $this->pageTitle = 'Buat Berita Baru';
        $this->showBasic = true;
        $this->showMedia = false;
        $this->showStatus = false;
        $this->showSeo = false;
    }

    public function generateSlug(): void
    {
        $this->slug = Str::slug($this->title);
    }

    public function save(): void
    {
        $service = app(ArticleService::class);
        $this->validate($service->validationRules($this->editingId));

        $data = [
            'title'            => $this->title,
            'content'          => $this->content,
            'summary'          => $this->summary,
            'status'           => $this->status,
            'scheduled_at'     => $this->scheduledAt,
            'meta_title'       => $this->metaTitle,
            'meta_description' => $this->metaDescription,
            'og_image'         => $this->ogImage,
            'focus_keyword'    => $this->focusKeyword,
            'image'            => $this->image,
        ];

        if ($this->editingId) {
            $article = Article::findOrFail($this->editingId);
            $service->update($article, $data);
            Session::flash('message', 'Artikel berhasil diperbarui.');
        } else {
            $service->create($data);
            Session::flash('message', 'Artikel berhasil dibuat.');
        }

        $this->resetForm();
        $this->showForm = false;
    }

    public function edit(int $id): void
    {
        $this->editingId = $id;
        $this->loadArticle($id);
        $this->pageTitle = 'Edit Berita';
        $this->showForm = true;
        $this->showBasic = true;
    }

    #[Computed]
    public function articles()
    {
        return app(ArticleService::class)->getFiltered($this->search, $this->statusFilter);
    }

    public function delete(int $id): void
    {
        $article = Article::findOrFail($id);
        app(ArticleService::class)->delete($article);
        Session::flash('message', 'Artikel berhasil dihapus.');
    }

    public function publish(int $id): void
    {
        $article = Article::findOrFail($id);
        app(ArticleService::class)->publish($article);
        Session::flash('message', 'Artikel berhasil dipublikasikan.');
    }

    public function setDraft(int $id): void
    {
        $article = Article::findOrFail($id);
        app(ArticleService::class)->draft($article);
        Session::flash('message', 'Artikel berhasil dijadikan draft.');
    }

    public function archive(int $id): void
    {
        $article = Article::findOrFail($id);
        app(ArticleService::class)->archive($article);
        Session::flash('message', 'Artikel berhasil diarsipkan.');
    }

    protected function loadArticle(int $id): void
    {
        $article = Article::findOrFail($id);
        $this->title            = $article->title;
        $this->slug             = $article->slug;
        $this->content          = $article->content;
        $this->summary          = $article->summary ?? '';
        $this->status           = $article->status;
        $this->image            = $article->image;
        $this->scheduledAt      = $article->scheduled_at?->format('Y-m-d\TH:i');
        $this->metaTitle        = $article->meta_title;
        $this->metaDescription  = $article->meta_description;
        $this->ogImage          = $article->og_image;
        $this->focusKeyword     = $article->focus_keyword;
    }

    public function render()
    {
        return view('livewire.admin.berita');
    }
}
