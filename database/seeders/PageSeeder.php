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
        Page::create([
            'title' => ['en' => 'Privacy Policy', 'ar' => 'سياسة الخصوصية'],
            'slug' => 'privacy-policy',
            'body' => null,
        ]);

        Page::create([
            'title' => ['en' => 'Terms Of Service', 'ar' => 'شروط الاستخدام'],
            'slug' => 'terms-of-service',
            'body' => null,
        ]);

        Page::create([
            'title' => ['en' => 'About Us', 'ar' => 'من نحن'],
            'slug' => 'about-us',
            'body' => null,
        ]);
    }
}
