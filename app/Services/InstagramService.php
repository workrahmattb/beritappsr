<?php

namespace App\Services;

use App\Models\InstagramSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InstagramService
{
    private const CACHE_KEY = 'instagram_feed';

    private const CACHE_TTL = 3600; // 1 jam

    private const API_VERSION = 'v22.0';

    private const MAX_POSTS = 9;

    private static ?InstagramSetting $setting = null;

    /**
     * Get the active Instagram setting (cached in memory per request).
     */
    private function getSetting(): ?InstagramSetting
    {
        if (self::$setting === null) {
            self::$setting = InstagramSetting::getActive();
        }

        return self::$setting;
    }

    /**
     * Get Instagram feed posts with caching.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getFeed(): array
    {
        $setting = $this->getSetting();

        if (! $setting || empty($setting->access_token) || empty($setting->user_id)) {
            return [];
        }

        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () use ($setting) {
            return $this->fetchFeed($setting->access_token, $setting->user_id);
        });
    }

    /**
     * Check if Instagram is configured and active.
     */
    public function isActive(): bool
    {
        $setting = $this->getSetting();

        return $setting
            && $setting->is_active
            && ! empty($setting->access_token)
            && ! empty($setting->user_id);
    }

    /**
     * Get Instagram username (for link in footer).
     */
    public function getUsername(): string
    {
        $setting = $this->getSetting();

        return $setting->username ?? 'syafaaturrasul';
    }

    /**
     * Fetch fresh feed from Instagram Graph API.
     *
     * @return array<int, array<string, mixed>>
     */
    private function fetchFeed(string $accessToken, string $userId): array
    {
        $url = sprintf(
            'https://graph.facebook.com/%s/%s/media',
            self::API_VERSION,
            $userId
        );

        $response = Http::get($url, [
            'fields' => 'id,caption,media_type,media_url,permalink,thumbnail_url,timestamp',
            'limit' => self::MAX_POSTS,
            'access_token' => $accessToken,
        ]);

        if ($response->failed()) {
            Log::error('Instagram API request failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [];
        }

        $data = $response->json();

        return $this->formatPosts($data['data'] ?? []);
    }

    /**
     * Format raw API response into a clean array for the view.
     *
     * @param  array<int, array<string, mixed>>  $posts
     * @return array<int, array<string, mixed>>
     */
    private function formatPosts(array $posts): array
    {
        return array_map(function (array $post) {
            $imageUrl = match ($post['media_type'] ?? 'IMAGE') {
                'VIDEO' => $post['thumbnail_url'] ?? $post['media_url'] ?? '',
                'CAROUSEL_ALBUM' => $post['media_url'] ?? '',
                default => $post['media_url'] ?? '',
            };

            $caption = $post['caption'] ?? '';
            if (mb_strlen($caption) > 120) {
                $caption = mb_substr($caption, 0, 120).'...';
            }

            return [
                'id' => $post['id'] ?? '',
                'media_type' => $post['media_type'] ?? 'IMAGE',
                'image_url' => $imageUrl,
                'permalink' => $post['permalink'] ?? '#',
                'caption' => $caption,
                'timestamp' => $post['timestamp'] ?? '',
                'is_video' => ($post['media_type'] ?? 'IMAGE') === 'VIDEO',
            ];
        }, $posts);
    }

    /**
     * Clear the cached feed.
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
