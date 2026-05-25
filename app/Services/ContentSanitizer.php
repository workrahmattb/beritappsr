<?php

namespace App\Services;

use Illuminate\Support\Facades\Purifier;

class ContentSanitizer
{
    protected array $allowedTags = [
        'p', 'br', 'strong', 'em', 'u', 's', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
        'ul', 'ol', 'li', 'blockquote', 'pre', 'code', 'hr',
        'a', 'img', 'span', 'div',
        'table', 'thead', 'tbody', 'tr', 'th', 'td',
    ];

    protected array $allowedAttributes = [
        'a' => ['href', 'title', 'target', 'rel'],
        'img' => ['src', 'alt', 'width', 'height', 'data-*'],
        'span' => ['style'],
        'div' => ['style'],
        '*' => ['class', 'style'],
    ];

    public function sanitize(string $html): string
    {
        $sanitized = preg_replace('/<(script|iframe|object|embed|form|input|button)\b[^>]*>.*?<\/\1>/is', '', $html);

        $sanitized = preg_replace('/\ron\w+\s*=\s*["\'][^"\']*["\']|on\w+\s*=\s*\S+/i', '', $sanitized);

        return trim($sanitized);
    }

    public function validateImageSrc(string $src): bool
    {
        if (str_starts_with($src, 'data:image')) {
            return true;
        }

        if (filter_var($src, FILTER_VALIDATE_URL)) {
            return true;
        }

        if (str_starts_with($src, '/storage/')) {
            return true;
        }

        return false;
    }
}
