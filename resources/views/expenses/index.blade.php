<x-app-layout>
    <div class="container mx-auto mt-6 p-4 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-4">Lista de Gastos</h1>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-left">Título</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Descripción</th>
                <th class="border border-gray-300 px-4 py-2 text-right">Total (€)</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Fecha</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Pagado</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($expenses as $expense)
                <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                    <td class="border border-gray-300 px-4 py-2">{{ $expense->title }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $expense->description }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">{{ number_format($expense->total, 2) }}€</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $expense->registered_at->format('d/m/Y') }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <form action="{{ route('expenses.togglePaid', $expense) }}" method="POST">
                            @csrf
                            <input type="checkbox" class="h-5 w-5 text-blue-500" onchange="this.form.submit()" {{ $expense->paid ? 'checked' : '' }}>
                        </form>
                    </td>
                    <td class="border border-gray-300 px-4 py-2 flex justify-evenly">
                        <a href="{{ route('expenses.edit', $expense) }}" class="text-blue-500 hover:underline">Editar</a>
                        <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline ml-2" onclick="return confirm('¿Estás seguro de eliminar este gasto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-6 p-4 bg-gray-50 rounded-lg shadow-md flex wrap justify-evenly">
            <p class="text-lg"><strong>Total gastos:</strong> <span class="text-gray-700">{{ $total }}€</span></p>
            <p class="text-lg"><strong>Total pagado:</strong> <span class="text-green-600">{{ $expenses->where('paid', true)->sum('total') }}€</span></p>
            <p class="text-lg"><strong>Total no pagado:</strong> <span class="text-red-600">{{ $expenses->where('paid', false)->sum('total') }}€</span></p>
            <a href="{{ route('expenses.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Gasto</a>
        </div>
    </div>
</x-app-layout>
