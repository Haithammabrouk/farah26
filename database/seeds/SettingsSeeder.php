<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => config('app.name'),
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Name',
                'description' => 'The name of your website'
            ],
            [
                'key' => 'site_description',
                'value' => 'Luxury Nile Cruise Booking System',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Site Description',
                'description' => 'A brief description of your website'
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@example.com',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Contact Email',
                'description' => 'Email address for customer inquiries'
            ],
            [
                'key' => 'contact_phone',
                'value' => '+1234567890',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Contact Phone',
                'description' => 'Phone number for customer inquiries'
            ],

            // Integrations
            [
                'key' => 'google_tag_manager_id',
                'value' => 'GTM-WC3SSBB',
                'type' => 'text',
                'group' => 'integrations',
                'label' => 'Google Tag Manager ID',
                'description' => 'Your Google Tag Manager container ID (e.g., GTM-XXXXXXX)'
            ],
            [
                'key' => 'google_analytics_id',
                'value' => '',
                'type' => 'text',
                'group' => 'integrations',
                'label' => 'Google Analytics ID',
                'description' => 'Your Google Analytics tracking ID (e.g., UA-XXXXXXXXX-X or G-XXXXXXXXXX)'
            ],
            [
                'key' => 'facebook_pixel_id',
                'value' => '',
                'type' => 'text',
                'group' => 'integrations',
                'label' => 'Facebook Pixel ID',
                'description' => 'Your Facebook Pixel ID for tracking'
            ],

            // SEO Settings
            [
                'key' => 'seo_meta_title',
                'value' => 'Luxury Nile Cruise Booking',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Default Meta Title',
                'description' => 'Default meta title for pages without specific SEO settings'
            ],
            [
                'key' => 'seo_meta_description',
                'value' => 'Book your luxury Nile cruise experience with us',
                'type' => 'textarea',
                'group' => 'seo',
                'label' => 'Default Meta Description',
                'description' => 'Default meta description for pages without specific SEO settings'
            ],
            [
                'key' => 'seo_meta_keywords',
                'value' => 'nile cruise, luxury cruise, egypt travel',
                'type' => 'textarea',
                'group' => 'seo',
                'label' => 'Default Meta Keywords',
                'description' => 'Default meta keywords for pages without specific SEO settings'
            ],

            // Social Media
            [
                'key' => 'facebook_url',
                'value' => '',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Facebook URL',
                'description' => 'Your Facebook page URL'
            ],
            [
                'key' => 'twitter_url',
                'value' => '',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Twitter URL',
                'description' => 'Your Twitter profile URL'
            ],
            [
                'key' => 'instagram_url',
                'value' => '',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Instagram URL',
                'description' => 'Your Instagram profile URL'
            ],

            // Booking Settings
            [
                'key' => 'booking_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'booking',
                'label' => 'Enable Bookings',
                'description' => 'Enable or disable online bookings'
            ],
            [
                'key' => 'booking_advance_days',
                'value' => '3',
                'type' => 'number',
                'group' => 'booking',
                'label' => 'Advance Booking Days',
                'description' => 'Minimum number of days in advance for bookings'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
