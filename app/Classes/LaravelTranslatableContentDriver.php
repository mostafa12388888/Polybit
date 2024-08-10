<?php

namespace App\Classes;

use Filament\SpatieLaravelTranslatableContentDriver;
use Illuminate\Database\Eloquent\Builder;

use function Filament\Support\generate_search_column_expression;

class LaravelTranslatableContentDriver extends SpatieLaravelTranslatableContentDriver
{
    public function applySearchConstraintToQuery(Builder $query, string $column, string $search, string $whereClause, ?bool $isCaseInsensitivityForced = null): Builder
    {
        /** @var Connection $databaseConnection */
        $databaseConnection = $query->getConnection();

        $column = match ($databaseConnection->getDriverName()) {
            'pgsql' => "{$column}->>'{$this->activeLocale}'",
            default => "{$column}",
        };

        return $query->{$whereClause}(
            generate_search_column_expression($column, $isCaseInsensitivityForced, $databaseConnection),
            'like',
            (string) str($search)->wrap('%'),
        );
    }
}
