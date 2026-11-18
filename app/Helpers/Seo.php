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
     * @param  string|null  $title  Page title
     * @param  string|null  $description  Meta description
     * @param  string  $type  Schema type: 'website', 'app', 'profile', 'article', 'webpage'
     * @param  string|null  $image  OG image URL
     * @param  array  $extra  Extra data (e.g. published_time, tags, section, breadcrumbs, faq, carousel)
     */
    public static function metaTags(
        ?string $title = null,
        ?string $description = null,
        string $type = 'website',
        ?string $image = null,
        array $extra = [],
    ): SEOData {
        $image = $image ?: asset('logo.png');
        $schema = self::getSchema($type, $extra, $image, $description);

        if (isset($extra['breadcrumbs'])) {
            $schema->push(self::breadcrumbSchema($extra['breadcrumbs']));
        }

        if (isset($extra['faq']) && is_array($extra['faq'])) {
            $schema->push(self::faqSchema($extra['faq']));
        }

        if (isset($extra['carousel'])) {
            $schema->push(self::carouselSchema($extra['carousel']));
        }

        $currentCleanUrl = url()->current();
        $enUrl = $currentCleanUrl;
        $arUrl = $currentCleanUrl.'?lang=ar';
        $canonicalUrl = app()->getLocale() === 'ar' ? $arUrl : $enUrl;

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
    protected static function getSchema(string $type, array $extra = [], ?string $image = null, ?string $description = null): SchemaCollection
    {
        $schema = SchemaCollection::initialize();

        $organization = [
            '@type' => 'Organization',
            'name' => config('app.name', 'TextFood Calorie AI'),
            'url' => config('app.url'),
            'logo' => asset('logo.png'),
        ];

        match ($type) {
            'website' => $schema->push([
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => config('app.name', 'TextFood Calorie AI'),
                'url' => config('app.url'),
                'inLanguage' => app()->getLocale(),
                'publisher' => $organization,
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => config('app.url').'/?search={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ],
            ]),

            'app', 'software' => $schema->push([
                '@context' => 'https://schema.org',
                '@type' => ['SoftwareApplication', 'WebApplication'],
                'name' => $extra['app_name'] ?? config('app.name', 'TextFood Calorie AI'),
                'description' => $extra['app_description'] ?? ($description ?? ''),
                'image' => $image ?: asset('logo.png'),
                'url' => $extra['app_url'] ?? url()->current(),
                'applicationCategory' => 'HealthApplication',
                'operatingSystem' => 'All (Web Browser, iOS, Android, Desktop)',
                'inLanguage' => app()->getLocale(),
                'offers' => [
                    '@type' => 'Offer',
                    'price' => '0',
                    'priceCurrency' => 'USD',
                    'availability' => 'https://schema.org/InStock',
                ],
                'publisher' => $organization,
                'featureList' => [
                    'AI-powered natural language meal logging',
                    'Automatic calorie and macronutrient breakdown',
                    'Personalized daily calorie target, BMR, and TDEE calculator',
                    'Daily water intake tracker',
                    'Weight logs and progress monitoring',
                ],
            ]),

            'profile' => $schema->push([
                '@context' => 'https://schema.org',
                '@type' => 'ProfilePage',
                'name' => $extra['profile_name'] ?? '',
                'url' => url()->current(),
                'mainEntity' => [
                    '@type' => 'Person',
                    'name' => $extra['profile_name'] ?? '',
                    'url' => url()->current(),
                    'image' => $extra['profile_image'] ?? null,
                    'description' => $extra['profile_description'] ?? '',
                ],
                'publisher' => $organization,
            ]),

            'article' => $schema->push([
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'headline' => $extra['headline'] ?? '',
                'inLanguage' => app()->getLocale(),
                'publisher' => $organization,
                'datePublished' => $extra['published_time'] ?? null,
                'dateModified' => $extra['modified_time'] ?? null,
            ]),

            default => $schema->push([
                '@context' => 'https://schema.org',
                '@type' => 'WebPage',
                'name' => config('app.name', 'TextFood Calorie AI'),
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
