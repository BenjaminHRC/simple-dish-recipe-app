<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Dish') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col gap-4">
                    <img class="rounded-lg w-96 h-64 object-cover" 
                        src="{{ str_contains($dish->image, 'dishes') ? Storage::url($dish->image) : $dish->image }}" 
                        alt="{{ $dish->name }}" />
                    <h1 class="text-2xl text-gray-900 dark:text-gray-100">{{ $dish->name }}</h1>
                    <p class="text-gray-600 dark:text-gray-400">{{ $dish->recette }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 