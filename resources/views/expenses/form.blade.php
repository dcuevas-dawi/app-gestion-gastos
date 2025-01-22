<x-app-layout>
    <div class="max-w-4xl mx-auto mt-8">
        <h1 class="text-2xl font-bold">{{ isset($expense) ? 'Editar Gasto' : 'Agregar Gasto' }}</h1>
        <form action="{{ isset($expense) ? route('expenses.update', $expense) : route('expenses.store') }}" method="POST">
            @csrf
            @isset($expense) @method('PUT') @endisset
            <div class="mt-4">
                <label class="block">Título:</label>
                <input type="text" name="title" value="{{ old('title', $expense->title ?? '') }}" class="border w-full px-4 py-2 rounded">
            </div>
            <div class="mt-4">
                <label class="block">Descripción:</label>
                <textarea name="description" class="border w-full px-4 py-2 rounded">{{ old('description', $expense->description ?? '') }}</textarea>
            </div>
            <div class="mt-4">
                <label class="block">Total:</label>
                <input type="number" step="0.01" name="total" value="{{ old('total', $expense->total ?? '') }}" class="border w-full px-4 py-2 rounded">
            </div>
            <div class="mt-4">
                <label class="block">Fecha:</label>
                <input type="date" name="registered_at" value="{{ old('registered_at', $expense->registered_at ?? '') }}" class="border w-full px-4 py-2 rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
                {{ isset($expense) ? 'Actualizar' : 'Agregar' }}
            </button>
        </form>
    </div>
</x-app-layout>
