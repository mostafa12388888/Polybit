<x-app-layout>
    <x-slot name="title">{!! __('Profile') !!}</x-slot>
    
    <x-slot name="heading">{!! __('Profile') !!}</x-slot>

    <x-slot name="breadcrumbs">
        <x-breadcrumb :last="true">{{ __('Profile') }}</x-breadcrumb>
    </x-slot>

    <div class="px-4 sm:px-6 py-12">
        <div class="container mx-auto space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-dark-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-dark-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-dark-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
