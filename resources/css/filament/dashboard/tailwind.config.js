import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/**/*.php',
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './resources/views/vendor/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/kenepa/translation-manager/resources/**/*.blade.php',
        './vendor/statikbe/laravel-filament-chained-translation-manager/**/*.blade.php',
        './vendor/awcodes/filament-quick-create/resources/**/*.blade.php',
        './vendor/awcodes/filament-curator/resources/**/*.blade.php',
        './vendor/awcodes/filament-tiptap-editor/resources/**/*.blade.php',
        './vendor/awcodes/filament-table-repeater/resources/**/*.blade.php',
        './vendor/awcodes/palette/resources/views/**/*.blade.php',
    ],

    safelist: [
      'tiptap-content',
      'filament-tiptap-grid-builder',
      'filament-tiptap-grid',
      'fi-in-table-repeatable',
      'filament-table-repeatable',
      'treeselect-input__tags-count',
    ],
}
