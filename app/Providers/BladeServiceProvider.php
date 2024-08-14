<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('minifyInclude', function ($expression) {
            // Parse the expression to separate the view name and variables
            $parsedExpression = Blade::stripParentheses($expression);

            // Separate view name and variables
            [$view, $variables] = array_pad(explode(',', $parsedExpression, 2), 2, '[]');

            // Render the view with the given variables
            return "<?php 
                \$html = \$__env->make({$view}, {$variables}, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); 
                \$lines = explode(PHP_EOL, \$html);
                \$trimmed_lines = array_map('trim', \$lines);
                \$minified_html = implode(' ', \$trimmed_lines);
                echo \$minified_html;
            ?>";
        });
    }
}
