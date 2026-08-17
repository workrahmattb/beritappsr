<?php

namespace App\Services;

class ContentSanitizer
{
    /**
     * Sanitize HTML content using HTML Purifier.
     * Removes malicious tags/attributes while preserving allowed RichEditor markup.
     */
    public function sanitize(string $html): string
    {
        $cleaned = \Purifier::clean($html);

        return trim($cleaned);
    }

    /**
     * Validate an image source URL.
     */
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
