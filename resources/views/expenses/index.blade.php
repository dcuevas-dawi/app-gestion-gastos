<x-app-layout>
    <div class="max-w-4xl mx-auto mt-8">
        <div class="flex justify-evenly mb-10">
            <p class="text-2xl font-bold">Gastos</p>
            <a href="{{ route('expenses.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Gasto</a>
        </div>

        <table class="table-auto w-full text-left">
            <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $expense->title }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->total }}</td>
                    <td>{{ $expense->registered_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('expenses.edit', $expense) }}" class="text-blue-500">Editar</a>

                        <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('¿Estás seguro de eliminar este gasto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
