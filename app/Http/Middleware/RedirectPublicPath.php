<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectPublicPath
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $url = request()->server('REQUEST_URI');
        $new_url = $url;
        $new_url = preg_replace('/^\/public/', '', $new_url);
        $new_url = preg_replace('/^\/index.php/', '', $new_url);

        if ($url != $new_url) {
            return redirect()->to(config('app.url').'$new_url');
        }

        return $next($request);
    }
}
