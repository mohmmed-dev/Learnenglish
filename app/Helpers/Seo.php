<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Seo
{
    /**
     * Generate SEO meta tags for a page.
     *
     * @param  string|null  $title        Page title
     * @param  string|null  $description  Meta description
     * @param  string       $type         Schema type: 'website', 'lesson', 'playlist', 'category', 'article', 'webpage'
     * @param  string|null  $image        OG image URL
     * @param  array        $extra        Extra data (e.g. video_url, duration, breadcrumbs, faq, carousel, published_time)
     */
    public static function metaTags(
        ?string $title = null,
        ?string $description = null,
        string $type = 'website',
        ?string $image = null,
        array $extra = [],
    ): SEOData {
        $siteName = config('app.name', 'LearnEnglish Audio');
        $defaultDescription = __('Turn real YouTube videos into interactive English lessons. Listen, shadow, and master natural English conversations with synchronized audio transcripts.');
        
        $title = $title ?: $siteName;
        $description = $description ?: $defaultDescription;
        $image = $image ?: asset('logo.png');

        $schema = self::getSchema($type, $extra, $image, $description, $title);

        if (isset($extra['breadcrumbs']) && is_array($extra['breadcrumbs'])) {
            $schema->push(self::breadcrumbSchema($extra['breadcrumbs']));
        }

        if (isset($extra['faq']) && is_array($extra['faq'])) {
            $schema->push(self::faqSchema($extra['faq']));
        }

        if (isset($extra['carousel']) && is_array($extra['carousel'])) {
            $schema->push(self::carouselSchema($extra['carousel']));
        }

        $canonicalUrl = url()->current();

        return new SEOData(
            title: $title,
            description: $description,
            image: $image,
            schema: $schema,
            locale: app()->getLocale(),
            canonical_url: $canonicalUrl,
            published_time: isset($extra['published_time']) ? Carbon::parse($extra['published_time']) : null,
            modified_time: isset($extra['modified_time']) ? Carbon::parse($extra['modified_time']) : null,
            section: $extra['section'] ?? null,
            tags: $extra['tags'] ?? null,
        );
    }

    /**
     * Build structured data schema based on page type.
     */
    protected static function getSchema(
        string $type,
        array $extra = [],
        ?string $image = null,
        ?string $description = null,
        ?string $title = null,
    ): SchemaCollection {
        $schema = SchemaCollection::initialize();
        $siteName = config('app.name', 'LearnEnglish Audio');
        $siteUrl = config('app.url', url('/'));

        $organization = [
            '@type' => 'EducationalOrganization',
            'name' => $siteName,
            'url' => $siteUrl,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('logo.svg'),
            ],
            'sameAs' => [
                config('services.youtube.channel_url', 'https://www.youtube.com/'),
            ],
        ];

        match ($type) {
            'website' => $schema->push([
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => $siteName,
                'url' => $siteUrl,
                'inLanguage' => app()->getLocale(),
                'description' => $description,
                'publisher' => $organization,
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => url(app()->getLocale() . '/lessons') . '?q={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ],
            ]),

            'lesson', 'video' => $schema->push([
                '@context' => 'https://schema.org',
                '@type' => ['LearningResource', 'VideoObject'],
                'name' => $title,
                'description' => $description,
                'thumbnailUrl' => [$image ?: asset('logo.png')],
                'uploadDate' => isset($extra['published_time']) ? Carbon::parse($extra['published_time'])->toIso8601String() : Carbon::now()->toIso8601String(),
                'contentUrl' => $extra['video_url'] ?? $extra['youtube_url'] ?? url()->current(),
                'embedUrl' => $extra['embed_url'] ?? ($extra['youtube_url'] ?? null),
                'inLanguage' => 'en',
                'educationalLevel' => $extra['level'] ?? 'Intermediate',
                'learningResourceType' => 'Lesson',
                'publisher' => $organization,
            ]),

            'playlist' => $schema->push([
                '@context' => 'https://schema.org',
                '@type' => 'CollectionPage',
                'name' => $title,
                'description' => $description,
                'url' => url()->current(),
                'inLanguage' => app()->getLocale(),
                'publisher' => $organization,
            ]),

            'category' => $schema->push([
                '@context' => 'https://schema.org',
                '@type' => 'CollectionPage',
                'name' => $title,
                'description' => $description,
                'url' => url()->current(),
                'inLanguage' => app()->getLocale(),
                'publisher' => $organization,
            ]),

            'article' => $schema->push([
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'headline' => $title,
                'description' => $description,
                'image' => $image,
                'inLanguage' => app()->getLocale(),
                'publisher' => $organization,
                'datePublished' => isset($extra['published_time']) ? Carbon::parse($extra['published_time'])->toIso8601String() : null,
                'dateModified' => isset($extra['modified_time']) ? Carbon::parse($extra['modified_time'])->toIso8601String() : null,
            ]),

            default => $schema->push([
                '@context' => 'https://schema.org',
                '@type' => 'WebPage',
                'name' => $title,
                'description' => $description,
                'url' => url()->current(),
                'inLanguage' => app()->getLocale(),
                'publisher' => $organization,
            ]),
        };

        return $schema;
    }

    /**
     * Build breadcrumb structured data.
     */
    protected static function breadcrumbSchema(array $breadcrumbs): array
    {
        $listItems = [];
        foreach ($breadcrumbs as $index => $breadcrumb) {
            $listItems[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $breadcrumb['name'],
                'item' => $breadcrumb['url'] ?? null,
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $listItems,
        ];
    }

    /**
     * Build FAQ structured data.
     */
    protected static function faqSchema(array $faq): array
    {
        $mainEntity = [];
        foreach ($faq as $item) {
            $mainEntity[] = [
                '@type' => 'Question',
                'name' => $item['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $item['answer'],
                ],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $mainEntity,
        ];
    }

    /**
     * Build carousel (ItemList) structured data.
     */
    protected static function carouselSchema(array $carousel): array
    {
        $listItems = [];
        foreach ($carousel as $index => $item) {
            $listItem = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'url' => $item['url'] ?? null,
            ];

            if (isset($item['name'])) {
                $listItem['name'] = $item['name'];
            }

            if (isset($item['image'])) {
                $listItem['image'] = $item['image'];
            }

            $listItems[] = $listItem;
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'itemListElement' => $listItems,
        ];
    }
}
