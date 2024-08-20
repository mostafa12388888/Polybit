<?php

namespace App\Console\Commands;

use App\Models\BlogCategory;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\StoreCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $startTime = microtime(true);

        Storage::disk('public')->makeDirectory('sitemaps');

        $this->generate_pages_sitemap();

        $this->generate_blog_categories_sitemap();
        $this->generate_posts_sitemap();

        $this->generate_store_categories_sitemap();
        $this->generate_products_sitemap();

        $this->generate_projects_sitemap();

        $this->generate_sitemap_index();

        $executionTime = microtime(true) - $startTime;
        Log::channel('sitemap')->info("Sitemaps generated in {$executionTime} seconds");
        $this->info("Sitemaps generated in {$executionTime} seconds");
    }

    public function generate_pages_sitemap()
    {
        $sitemap = Sitemap::create();

        foreach (['home', 'login', 'register', 'cart', 'request-quote', 'contact-us', 'faq', 'products.index', 'posts.index', 'projects.index'] as $page) {
            $this->add($sitemap, route($page));
        }

        foreach (Page::all() as $page) {
            $this->add($sitemap, route('pages.show', $page));
        }

        $sitemap->writeToFile(Storage::disk('public')->path('/sitemaps/pages_sitemap.xml'));
    }

    public function generate_blog_categories_sitemap()
    {
        $sitemap = Sitemap::create();

        foreach (BlogCategory::all() as $category) {
            $this->add($sitemap, route('blog-categories.show', $category));
        }

        $sitemap->writeToFile(Storage::disk('public')->path('/sitemaps/blog_categories_sitemap.xml'));
    }

    public function generate_posts_sitemap()
    {
        $sitemap = Sitemap::create();

        foreach (Post::all() as $post) {
            $this->add($sitemap, route('posts.show', $post), $post->locales(), $post->updated_at);
        }

        $sitemap->writeToFile(Storage::disk('public')->path('/sitemaps/posts_sitemap.xml'));
    }

    public function generate_store_categories_sitemap()
    {
        $sitemap = Sitemap::create();

        foreach (StoreCategory::all() as $category) {
            $this->add($sitemap, route('store-categories.show', $category));
        }

        $sitemap->writeToFile(Storage::disk('public')->path('/sitemaps/store_categories_sitemap.xml'));
    }

    public function generate_products_sitemap()
    {
        $sitemap = Sitemap::create();

        foreach (Product::all() as $product) {
            $this->add($sitemap, route('products.show', $product), $product->locales());
        }

        $sitemap->writeToFile(Storage::disk('public')->path('/sitemaps/products_sitemap.xml'));
    }

    public function generate_projects_sitemap()
    {
        $sitemap = Sitemap::create();

        foreach (Project::all() as $project) {
            $this->add($sitemap, route('projects.show', $project), $project->locales());
        }

        $sitemap->writeToFile(Storage::disk('public')->path('/sitemaps/projects_sitemap.xml'));
    }

    public function generate_sitemap_index()
    {
        $index = SitemapIndex::create();

        foreach (['pages_sitemap', 'blog_categories_sitemap', 'posts_sitemap', 'projects_sitemap', 'store_categories_sitemap', 'products_sitemap'] as $sitemap) {
            $index->add(Storage::disk('public')->url('/sitemaps/'.$sitemap.'.xml'));
        }

        $index->writeToFile(public_path('sitemap.xml'));
    }

    public function add($sitemap, $url, $locales = [], $last_mod = null)
    {
        $locales = $locales ?: array_keys(locales());

        foreach ($locales as $locale) {
            $sitemap_url = Url::create(localized_url($locale, $url));

            if ($last_mod) {
                $sitemap_url = $sitemap_url->setLastModificationDate($last_mod);
            }

            $sitemap->add($sitemap_url);
        }
    }
}
