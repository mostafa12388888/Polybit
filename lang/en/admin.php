<?php

declare(strict_types=1);

$ar_translations_path = base_path('lang/ar/admin.php');

if (file_exists($ar_translations_path)) {
    $translations = include $ar_translations_path;

    $translations = array_combine(array_keys($translations), array_keys($translations));
}

return array_merge($translation ?? [], [
    'File' => 'ملف',
    'Files' => 'الملفات',
    'Files Manager' => 'مدير الملفات',
    'Settings' => 'الاعدادات',
    'Location' => 'Location',
    'Consultant' => 'Consultant',
    'Contractor' => 'Contractor',
]);
