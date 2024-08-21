<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->whereJsonContains('locales', app()->getLocale())
            ->with('image', 'category', 'user')->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (! $post->translated()) {
            return redirect()->route('posts.index');
        }

        $post->loadMissing('media', 'category', 'user');

        $related_posts = $post->category->posts()->whereJsonContains('locales', app()->getLocale())
            ->where('id', '!=', $post->id)->limit(6)->get();

        $latest_posts = Post::latest()->whereJsonContains('locales', app()->getLocale())
            ->whereNotIn('id', $related_posts->pluck('id'))
            ->where('id', '!=', $post->id)->limit(6)->get();

        return view('posts.show', compact('post', 'latest_posts', 'related_posts'));
    }

    public function category_posts(BlogCategory $category)
    {
        $posts = $category->is_parent_category() ? $category->sub_categories_posts() : $category->posts();

        $posts = $posts->latest()->whereJsonContains('locales', app()->getLocale())
            ->with('image', 'category', 'user')->paginate(12);

        return view('posts.index', compact('posts', 'category'));
    }
}
