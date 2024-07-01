<select multiple {!! $attributes->merge(['class' => 'w-full text-start !text-lg']) !!} x-init="new TomSelect($el, {
    plugins: ['remove_button', 'clear_button', 'checkbox_options'],
    valueField: 'value',
    searchField: 'search',
    render: {
        option: function(data, escape) {
            return `<div class='text-base !px-4 !py-2'>${escape(data.text)}</div>`;
        },
        item: function(data, escape) {
            return `<div class='text-sm justify-center items-start leading-relaxed'>${escape(data.text)}</div>`;
        }
    }
})">
    {{ $slot }}
</select>