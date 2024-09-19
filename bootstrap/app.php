<?php

use App\Http\Middleware\RedirectPublicPath;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        function (Request $request) {
            if (in_array($request->segment(1), array_keys(locales()))) {
                App::setLocale($request->segment(1));

                if (! (collect(locales(false))->where('code', $request->segment(1))->first()['default'] ?? false)) {
                    $prefix = $request->segment(1);
                }
            }

            Route::middleware('web')->prefix($prefix ?? null)->group(base_path('routes/web.php'));
        },
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(RedirectPublicPath::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e) {
            try {
                if ($e->getStatusCode() == 404) {
                    return redirect()->to(config('app.url'));
                }
            } catch (\Throwable $th) {
                //
            }
        });
    })->create();
