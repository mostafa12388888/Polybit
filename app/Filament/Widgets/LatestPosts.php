<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPosts extends BaseWidget
{
    protected static ?string $model = Post::class;

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return PostResource::table($table)
            ->heading(__('admin.Latest Posts'))
            ->modelLabel(__('admin.post'))
            ->pluralModelLabel(__('admin.posts'))
            ->query(Post::query());
    }
}
