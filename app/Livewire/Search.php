<?php

namespace App\Livewire;

use App\Models\BlogCategory;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\StoreCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    public $query = '';

    public function mount()
    {
        $this->query = request()->query('q', '');
    }

    public function render()
    {
        if (strlen($this->query) > 250) {
            $this->addError('query', __('Search query can\'t be longer than :count words', ['count' => 250]));
        } else {
            $this->resetValidation('query');

            if ($query = trim($this->query)) {
                $posts = Post::search($query)->with('image')->limit(10)->get();
                $products = Product::search($query)->with('image')->limit(10)->get();
                $projects = Project::search($query)->with('image')->limit(10)->get();
                $blog_categories = BlogCategory::search($query)->with('image')->limit(10)->get();
                $store_categories = StoreCategory::search($query)->with('image')->limit(10)->get();

                $results = collect()->merge($posts)->merge($products)->merge($projects)->merge($blog_categories)->merge($store_categories)->sortByDesc('relevance')->take(20);
            }
        }

        $this->js('document.querySelector(".search-results").scrollTo(0, 0)');

        return view('livewire.search', ['results' => $results ?? []]);
    }
}
