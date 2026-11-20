<?php

namespace App\Services;

use Alaouy\Youtube\Facades\Youtube;

class YouTubeService
{
    /**
     * Extract video ID from a YouTube URL or return the ID as-is.
     */
    public function extractVideoId(string $urlOrId): ?string
    {
        // If it's already just an ID (11 characters)
        if (preg_match('/^[\w-]{11}$/', $urlOrId)) {
            return $urlOrId;
        }

        // Parse various YouTube URL formats
        $patterns = [
            '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/v\/)([a-zA-Z0-9_-]{11})/',
            '/youtube\.com\/shorts\/([a-zA-Z0-9_-]{11})/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $urlOrId, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    /**
     * Fetch video details from YouTube API.
     *
     * @return array{title: string, description: string, thumbnail: string, youtube_url: string, duration: string}|null
     */
    public function getVideoDetails(string $urlOrId): ?array
    {
        $videoId = $this->extractVideoId($urlOrId);

        if (! $videoId) {
            return null;
        }

        try {
            $video = Youtube::getVideoInfo($videoId, ['snippet', 'contentDetails']);

            if (! $video) {
                return null;
            }

            $snippet = $video->snippet;
            $thumbnails = $snippet->thumbnails;

            // Pick best thumbnail available
            $thumbnail = $thumbnails->maxres->url
                ?? $thumbnails->high->url
                ?? $thumbnails->medium->url
                ?? $thumbnails->default->url
                ?? '';

            return [
                'title' => $snippet->title ?? '',
                'description' => $snippet->description ?? '',
                'thumbnail' => $thumbnail,
                'youtube_url' => "https://www.youtube.com/watch?v={$videoId}",
                'youtube_id' => $videoId,
                'duration' => $this->parseDuration($video->contentDetails->duration ?? ''),
            ];
        } catch (\Exception $e) {
            report($e);

            return null;
        }
    }

    /**
     * Convert ISO 8601 duration to human-readable format.
     */
    protected function parseDuration(string $isoDuration): string
    {
        if (empty($isoDuration)) {
            return '0:00';
        }

        try {
            $interval = new \DateInterval($isoDuration);
            $hours = $interval->h;
            $minutes = $interval->i;
            $seconds = $interval->s;

            if ($hours > 0) {
                return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
            }

            return sprintf('%d:%02d', $minutes, $seconds);
        } catch (\Exception) {
            return '0:00';
        }
    }
}
