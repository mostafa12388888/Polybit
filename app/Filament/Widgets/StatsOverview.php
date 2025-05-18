<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\PostResource;
use App\Filament\Resources\ProductResource;
use App\Filament\Resources\ProjectResource;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;

class StatsOverview extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $posts = Post::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()]);

        $products = Product::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()]);

        $projects = Project::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()]);

        $orders = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()]);

        return [
            Stat::make(__('admin.Products2'), Product::count())->icon('heroicon-o-squares-2x2')
                ->url(ProductResource::getUrl('index'))
                ->description(Number::forHumans($products->count(), abbreviate: true).' '.__('admin.Last Week'))
                ->descriptionIcon($products->count() ? 'heroicon-m-arrow-trending-up' : null, IconPosition::Before)
                ->color($products->count() ? 'success' : 'info')
                ->chart($products->groupBy('date')->pluck('count', 'date')->toArray()),

            Stat::make(__('admin.Orders'), Order::count())->icon('heroicon-o-shopping-cart')
                ->url(OrderResource::getUrl('index'))
                ->description(Number::forHumans($orders->count(), abbreviate: true).' '.__('admin.Last Week'))
                ->descriptionIcon($orders->count() ? 'heroicon-m-arrow-trending-up' : null, IconPosition::Before)
                ->color($orders->count() ? 'success' : 'info')
                ->chart($orders->groupBy('date')->pluck('count', 'date')->toArray()),

            Stat::make(__('admin.Posts'), Post::count())->icon('heroicon-o-document-text')
                ->url(PostResource::getUrl('index'))
                ->description(Number::forHumans($posts->count(), abbreviate: true).' '.__('admin.Last Week'))
                ->descriptionIcon($posts->count() ? 'heroicon-m-arrow-trending-up' : null, IconPosition::Before)
                ->color($posts->count() ? 'success' : 'info')
                ->chart($posts->groupBy('date')->pluck('count', 'date')->toArray()),

            Stat::make(__('admin.Projects'), Project::count())->icon('heroicon-o-building-office-2')
                ->url(ProjectResource::getUrl('index'))
                ->description(Number::forHumans($projects->count(), abbreviate: true).' '.__('admin.Last Week'))
                ->descriptionIcon($projects->count() ? 'heroicon-m-arrow-trending-up' : null, IconPosition::Before)
                ->color($projects->count() ? 'success' : 'info')
                ->chart($projects->groupBy('date')->pluck('count', 'date')->toArray()),
        ];
    }
}
