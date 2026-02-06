<?php

namespace App\Helpers;

use App\Models\meta;
use Illuminate\Support\Facades\Cache;

class MetaHelper
{
    /**
     * Get meta tags for a specific page
     *
     * @param string $pageName
     * @return array
     */
    public static function getMetaTags($pageName)
    {
        // Cache for 1 hour
        return Cache::remember("meta_tags_{$pageName}", 3600, function () use ($pageName) {
            $metaRecord = meta::where('name', $pageName)->first();

            if (!$metaRecord) {
                return [
                    'title' => config('app.name'),
                    'description' => 'Farah Nile Cruise - Luxury Nile cruises in Egypt',
                    'keywords' => 'nile cruise, egypt, luxury travel, farah cruise',
                ];
            }

            return [
                'title' => $metaRecord->title ?? config('app.name'),
                'description' => $metaRecord->description ?? '',
                'keywords' => $metaRecord->keywords ?? '',
            ];
        });
    }

    /**
     * Render meta tags as HTML
     *
     * @param string $pageName
     * @return string
     */
    public static function renderMetaTags($pageName)
    {
        $meta = self::getMetaTags($pageName);

        $title = htmlspecialchars($meta['title']);
        $description = htmlspecialchars($meta['description']);
        $keywords = htmlspecialchars($meta['keywords']);

        return <<<HTML
        <title>{$title}</title>
        <meta name="description" content="{$description}">
        <meta name="keywords" content="{$keywords}">

        <!-- Open Graph / Facebook -->
        <meta property="og:title" content="{$title}">
        <meta property="og:description" content="{$description}">
        <meta property="og:type" content="website">

        <!-- Twitter -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{$title}">
        <meta name="twitter:description" content="{$description}">
        HTML;
    }
}
