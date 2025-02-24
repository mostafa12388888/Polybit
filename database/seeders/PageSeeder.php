<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            'about-us' => ['en' => 'About Us', 'ar' => 'من نحن'],
            'privacy-policy' => ['en' => 'Privacy Policy', 'ar' => 'سياسة الخصوصية'],
            'terms-of-service' => ['en' => 'Terms Of Service', 'ar' => 'شروط الاستخدام'],
        ];

        foreach ($pages as $slug => $title) {
            Page::updateOrCreate(['slug' => $slug], [
                'title' => $title,
                'body' => null,
            ]);
        }

        foreach (Page::$preset_pages as $route => $title) {
            $slug = str($route)->replace('.', '-')->slug();

            // Update the slug of auth pages because curator picker thinks that it's filament auth pages and doesn't work
            $slug = in_array($slug, ['login', 'register']) ? 'auth-'.$slug : $slug;

            Page::updateOrCreate(['slug' => $slug], [
                'title' => collect(array_keys(locales(true)))->mapWithKeys(fn ($locale, $key) => [$locale => __($title, locale: $locale)])->toArray(),
                'body' => null,
                'route' => $route,
                'is_editable' => false,
            ]);
        }
    }
}
