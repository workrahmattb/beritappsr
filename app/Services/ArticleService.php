<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ArticleService
{
    public function __construct(protected ContentSanitizer $sanitizer) {}

    public function getFiltered(string $search = '', string $status = '', int $perPage = 10)
    {
        $query = Article::with('author');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($status !== '' && $status !== 'all') {
            $query->where('status', $status);
        }

        return $query->latest()->paginate($perPage);
    }

    public function create(array $data): Article
    {
        $content = $this->sanitizer->sanitize($data['content']);

        return Article::create([
            'title'            => $data['title'],
            'slug'             => $this->generateSlug($data['title']),
            'content'          => $content,
            'summary'          => $data['summary'] ?? null,
            'status'           => $data['status'] ?? 'draft',
            'published_at'     => $data['status'] === 'published' ? now() : null,
            'scheduled_at'     => $data['scheduled_at'] ?? null,
            'author_id'        => Auth::id(),
            'meta_title'       => $data['meta_title'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'og_image'         => $data['og_image'] ?? null,
            'focus_keyword'    => $data['focus_keyword'] ?? null,
            'image'            => $data['image'] ?? null,
        ]);
    }

    public function update(Article $article, array $data): Article
    {
        $updates = [
            'title'            => $data['title'],
            'slug'             => Str::slug($data['title']) !== $article->slug
                ? $this->generateSlug($data['title'])
                : $article->slug,
            'content'          => $this->sanitizer->sanitize($data['content']),
            'summary'          => $data['summary'] ?? null,
            'status'           => $data['status'],
            'meta_title'       => $data['meta_title'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'og_image'         => $data['og_image'] ?? null,
            'focus_keyword'    => $data['focus_keyword'] ?? null,
            'image'            => $data['image'] ?? $article->image,
            'scheduled_at'     => $data['scheduled_at'] ?? $article->scheduled_at,
        ];

        if ($data['status'] === 'published' && $article->isDraft()) {
            $updates['published_at'] = now();
        }

        $article->update($updates);

        return $article;
    }

    public function publish(Article $article): void
    {
        $article->update([
            'status'       => 'published',
            'published_at' => now(),
        ]);
    }

    public function draft(Article $article): void
    {
        $article->update([
            'status' => 'draft',
        ]);
    }

    public function archive(Article $article): void
    {
        $article->update([
            'status'       => 'archived',
            'published_at' => now(),
        ]);
    }

    public function delete(Article $article): void
    {
        $article->delete();
    }

    public function publishScheduledArticles(): int
    {
        $count = Article::scheduled()
            ->where('scheduled_at', '<=', now())
            ->update([
                'status'       => 'published',
                'published_at' => now(),
            ]);

        return $count;
    }

    public function validationRules(?int $articleId = null): array
    {
        return [
            'title'            => 'required|string|max:255',
            'slug'             => [
                'required',
                'string',
                'max:255',
                $articleId
                    ? "unique:articles,slug,{$articleId}"
                    : 'unique:articles,slug',
            ],
            'content'          => 'required|string',
            'summary'          => 'nullable|string|max:500',
            'status'           => 'required|in:draft,published,archived',
            'metaTitle'        => 'nullable|string|max:255',
            'metaDescription'  => 'nullable|string|max:500',
            'ogImage'          => 'nullable|string|max:255',
            'focusKeyword'     => 'nullable|string|max:255',
            'scheduledAt'      => 'nullable|date|after:now',
            'image'            => 'nullable|string|max:255',
        ];
    }

    protected function generateSlug(string $title): string
    {
        $slug = Str::slug($title);

        if (Article::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }

        return $slug;
    }
}
