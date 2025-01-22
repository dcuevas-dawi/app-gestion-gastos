<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Gasto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('expenses.update', $expense) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Título -->
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Título:</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $expense->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            @error('title')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Descripción:</label>
                            <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $expense->description) }}</textarea>
                        </div>

                        <!-- Total -->
                        <div class="mb-4">
                            <label for="total" class="block text-gray-700 text-sm font-bold mb-2">Total:</label>
                            <input type="number" name="total" id="total" value="{{ old('total', $expense->total) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <!-- Fecha -->
                        <div class="mb-4">
                            <label for="registered_at" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Registro:</label>
                            <input type="date" name="registered_at" id="registered_at" value="{{ old('registered_at', $expense->registered_at->format('Y-m-d')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Guardar cambios
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
