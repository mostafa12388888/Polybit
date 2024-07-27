<?php

declare(strict_types=1);

$ar_translations_path = base_path('lang/ar/admin.php');

if (file_exists($ar_translations_path)) {
    $translations = include $ar_translations_path;

    return array_combine(array_keys($translations), array_keys($translations));
}

return [
    'Location' => 'Location',
    'Consultant' => 'Consultant',
    'Contractor' => 'Contractor',
];
