<x-filament::page>
    <div class="fi-ta-ctn divide-y divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">

        <div class="p-4 space-y-6">
            <form wire:submit.prevent="submitFilters">
                <div class="flex items-start gap-3">
                    <div class="grow">
                        <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">
                            <div class="items-center gap-x-3 ps-3 flex border-e border-gray-200 pe-3 ps-3 dark:border-white/10">
                                <x-heroicon-o-magnifying-glass class="w-5 h-5 text-gray-400 dark:text-gray-500"/>
                            </div>
                        
                            <div class="min-w-0 flex-1">
                                <input class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3" id="searchTerm" placeholder="{{ __('filament-translation-manager::messages.search_term_placeholder') }}" type="text" wire:model="searchTerm" @input="$wire.submitFilters()">
                            </div>
                        </div>
                    </div>

                    {{-- <x-filament::button type="submit" icon="heroicon-o-funnel" class="flex-0 ml-4">
                        @lang('filament-translation-manager::messages.filter_action')
                    </x-filament::button> --}}
                </div>
            </form>

            {{-- <div class="flex text-sm gap-6 items-center flex-wrap">
                <div class="flex items-center gap-2">
                    <span><x-dynamic-component :component="'heroicon-o-funnel'" class="h-6 w-5"/></span>
                    <span>@lang('filament-translation-manager::messages.filter_results', ['filtered' => $totalFilteredTranslations, 'total' => $totalTranslations])</span>
                </div>

                @if($totalFilteredTranslations > 0)
                    <div class="flex items-center gap-2">
                        <span><x-dynamic-component :component="'heroicon-o-exclamation-circle'" class="h-6 w-5"/></span>
                        <span>@lang('filament-translation-manager::messages.filter_results_missing_translations', ['missing' => $totalMissingFilteredTranslations,
                            'percent' => number_format(($totalMissingFilteredTranslations / $totalFilteredTranslations) * 100, 0)])</span>
                    </div>
                @endif
            </div> --}}
        </div>


        @forelse($filteredTranslations as $translation)
            <livewire:translation-edit-form
                wire:key="{{ $translation['title'] }}.{{ implode('-', $selectedLocales) }}"
                :group="$translation['group']"
                :translation_key="$translation['translation_key']"
                :translations="$translation['translations']"
                :locales="$selectedLocales"
            />
        @empty
            @if(empty($translations))
                <div>@lang('filament-translation-manager::messages.error_no_translations_for_filters')</div>
            @else
                <div>@lang('filament-translation-manager::messages.error_no_translations_for_filters')</div>
            @endif
        @endforelse
    </div>
    
    <div id="pagination" class="flex justify-end">
        @if($pageCounter > 1)
            <x-filament::icon-button
                :label="__('filament-translation-manager::messages.previous_page')"
                icon="{{ direction() == 'ltr' ? 'heroicon-o-chevron-right' : 'heroicon-o-chevron-left' }}"
                class="ml-4 -mr-1"
                wire:click="previousPage" />
        @endif

        @if($totalFilteredTranslations > $pagedTranslations)
            <x-filament::icon-button
                :label="__('filament-translation-manager::messages.next_page')"
                icon="{{ direction() == 'ltr' ? 'heroicon-o-chevron-left' : 'heroicon-o-chevron-right' }}"
                class="ml-4 -mr-1"
                wire:click="nextPage" />
        @endif
    </div>
</x-filament::page>
