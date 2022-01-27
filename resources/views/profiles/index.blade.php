<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profiles') }}
        </h2>
    </x-slot>
    <x-slot name="breadcrumbs">
        <nav class="mb-2">
            <ol class="list-reset flex inline-flex items-center text-gray-500 text-xs">
                <li><a href="{{ route('dashboard') }}" class="hover:text-gray-600"><i class="fas fa-home"></i></a></li>
                <li><i class="fas fa-angle-right fa-sm mx-3"></i></li>
                <li>Profiles</li>
            </ol>
        </nav>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            @livewire('profiles-manager')

        </div>
    </div>
</x-app-layout>
