<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\StoreCategory;

class SearchController extends Controller
{
    public function __invoke()
    {
        $query = trim(str()->limit(trim(request()->q), 150, ''));

        if (! $query) {
            return redirect()->route('home');
        }

        $results = $this->search($query);

        return view('pages.search', compact('results'));
    }

    public function search($query)
    {
        $posts = Post::whereJsonContains('locales', app()->getLocale())->search($query)->with('image')->limit(10)->get();
        $products = Product::whereJsonContains('locales', app()->getLocale())->search($query)->with('image')->limit(10)->get();
        $projects = Project::whereJsonContains('locales', app()->getLocale())->search($query)->with('image')->limit(10)->get();
        $blog_categories = BlogCategory::search($query)->with('image')->limit(10)->get();
        $store_categories = StoreCategory::search($query)->with('image')->limit(10)->get();

        return collect()->merge($posts)->merge($products)->merge($projects)->merge($blog_categories)->merge($store_categories)->sortByDesc('relevance')->take(20);
    }
}
