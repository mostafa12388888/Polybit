<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\StoreCategory;
use Livewire\Component;

class Videos extends Component
{
    public $videos = [];

    public function mount($subject = null)
    {
        $videos = Product::where('videos', '!=', null)->where('videos', '!=', '')->where('videos', '!=', '[]')
            ->select('products.id', 'videos')
            ->with([
                'categories' => fn ($query) => $query->select('store_categories.id', 'parent_id'),
                'categories.parent' => fn ($query) => $query->select('store_categories.id'),
            ])
            ->get()
            ->map(function ($product) {
                return collect($product->getTranslation('videos', app()->getLocale(), false) ?: [])->map(function ($video) use ($product) {
                    return [
                        'url' => $video['url'],
                        'product' => $product->id,
                        'categories' => $product->categories->pluck('parent')->pluck('id')->toArray(),
                        'sub_categories' => $product->categories->pluck('id')->toArray(),
                    ];
                });
            })
            ->flatten(1)->groupBy('url')->map(function ($video_group) {
                $video = $video_group->first();
                $video['products'] = $video_group->pluck('product')->unique()->values()->toArray();
                unset($video['product']);

                return $video;
            })->values()->shuffle();

        if ($subject instanceof Product) {
            $videos = $videos->sort(fn ($video) => in_array($subject->id, $video['products']) ? 0 : 1);
        } elseif ($subject instanceof StoreCategory && $subject->parent_id) {
            $videos = $videos->sort(fn ($video) => in_array($subject->id, $video['sub_categories']) ? 0 : 1);
        } elseif ($subject instanceof StoreCategory) {
            $videos = $videos->sort(fn ($video) => in_array($subject->id, $video['categories']) ? 0 : 1);
        }

        $this->videos = $videos->take(5)->toArray();
    }

    public function render()
    {
        return view('livewire.videos');
    }
}
