@php
    $navigate = true;
    $url = $attributes->get('href');

    $domain = parse_url($url, PHP_URL_HOST);
    $current_domain = parse_url(url()->current(), PHP_URL_HOST);
    $navigate = $navigate && ($domain == $current_domain) ? true : false;
    
    try {
        $new_route = app('router')->getRoutes()->match(app('request')->create($url));
        $navigate = $navigate && $new_route->getName() == 'videos.show' ? true : false;
    } catch (\Throwable $th) {
        //
    }
@endphp


<a {{ $url && ! in_array($url, ['javascript:void(0)', '#']) && $navigate ? 'wire:navigate' : '' }} {{ $attributes->merge([
    'class' => 'flex items-center gap-2 w-full px-4 py-3 text-left text-[.92rem] leading-5 text-gray-700 dark:text-dark-200 hover:bg-gray-100 dark:hover:bg-dark-800/30 focus:outline-none focus:bg-gray-100 dark:focus:bg-dark-800/30 transition duration-150 ease-in-out']) 
}}>{{ $slot }}</a>
