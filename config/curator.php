<?php

return [
    'accepted_file_types' => [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/svg+xml',
        'application/pdf',
        'video/mp4',
        'application/octet-stream',
        'image/vnd.dwg',
        // the browser can't detect some files mimetypes like autocad dwg files
        // So adding empty type will make those files allowed on javascript validation
        // And these files will get validated again in the backend which will be more cabable of getting their real mimetype
        '',
    ],
    'cloud_disks' => [
        's3',
        'cloudinary',
        'imgix',
    ],
    'curation_formats' => [
        'jpg',
        'jpeg',
        'webp',
        'png',
        'avif',
    ],
    'curation_presets' => [
        \Awcodes\Curator\Curations\ThumbnailPreset::class,
    ],
    'directory' => 'media',
    'disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),
    'glide' => [
        'server' => \Awcodes\Curator\Glide\DefaultServerFactory::class,
        'fallbacks' => [
            \App\Classes\LogoGliderFallback::class,
            \App\Classes\UserGliderFallback::class,
        ],
        'route_path' => 'uploads',
    ],
    'image_crop_aspect_ratio' => null,
    'image_resize_mode' => null,
    'image_resize_target_height' => null,
    'image_resize_target_width' => null,
    'is_limited_to_directory' => false,
    'is_tenant_aware' => true,
    'tenant_ownership_relationship_name' => 'tenant',
    'max_size' => 20480,
    'model' => \App\Models\CuratorMedia::class,
    'min_size' => 0,
    'path_generator' => \App\Classes\MediaPathGenerator::class,
    'resources' => [
        'label' => 'Media',
        'plural_label' => 'Media',
        'navigation_group' => 'null',
        'cluster' => null,
        'navigation_label' => 'Media',
        'navigation_icon' => 'heroicon-o-photo',
        'navigation_sort' => 10,
        'navigation_count_badge' => false,
        'resource' => \Awcodes\Curator\Resources\MediaResource::class,
    ],
    'should_preserve_filenames' => true,
    'should_register_navigation' => true,
    'should_check_exists' => true,
    'visibility' => 'public',
    'tabs' => [
        'display_curation' => false,
        'display_upload_new' => true,
    ],
    // 'multi_select_key' => 'metaKey',
    'multi_select_key' => 'isTrusted',
    'table' => [
        'layout' => 'list',
    ],
];
