<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-row justify-evenly items-center bg-white p-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                {{ __("¡Estás loguead@!") }}
                <a href="{{ url('/') }}" class="h-full bg-blue-500 text-white px-4 py-2 rounded">Ir a la App</a>

            </div>
        </div>
    </div>
</x-app-layout>
