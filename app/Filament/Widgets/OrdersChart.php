<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Contracts\Support\Htmlable;

class OrdersChart extends ChartWidget
{
    public ?string $filter = 'week';

    protected static ?string $maxHeight = '400px';

    protected int|string|array $columnSpan = 2;

    protected static ?int $sort = 2;

    protected function getFilters(): ?array
    {
        return [
            'day' => __('admin.Day'),
            'week' => __('admin.Week'),
            'month' => __('admin.Month'),
            'year' => __('admin.Year'),
        ];
    }

    protected function getData(): array
    {
        $data = Trend::model(Order::class);

        if ($this->filter == 'day') {
            $data = $data->between(
                start: now()->endOfDay()->subDay()->addSecond(),
                end: now()->endOfDay(),
            )->perHour()->count();

            $labels = $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->translatedFormat('H:00'));
            $data = $data->map(fn (TrendValue $value) => $value->aggregate);
        } elseif ($this->filter == 'week') {
            $data = $data->between(
                start: now()->endOfDay()->subWeek()->addSecond(),
                end: now()->endOfDay(),
            )->perDay()->count();

            $labels = $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->translatedFormat('D'));
            $data = $data->map(fn (TrendValue $value) => $value->aggregate);
        } elseif ($this->filter == 'month') {
            $data = $data->between(
                start: now()->endOfDay()->subMonth()->addSecond(),
                end: now()->endOfDay(),
            )->perDay()->count();

            $labels = $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->translatedFormat('d'));
            $data = $data->map(fn (TrendValue $value) => $value->aggregate);
        } else {
            $data = $data->between(
                start: now()->endOfMonth()->subYear()->addSecond(),
                end: now()->endOfMonth(),
            )->perMonth()->count();

            $labels = $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->translatedFormat('M'));
            $data = $data->map(fn (TrendValue $value) => $value->aggregate);
        }

        return [
            'datasets' => [
                ['label' => 'Orders Added', 'data' => $data],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function getHeading(): string|Htmlable|null
    {
        return __('admin.Orders');
    }

    public static function canView(): bool
    {
        return auth()->user()->can('view-any-order');
    }
}
