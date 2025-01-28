<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los gastos del usuario autenticado
        $expenses = Expense::where('user_id', auth()->id())->get();

        // Calcular el total acumulado
        $total = $expenses->sum('total');

        return view('expenses.index', compact('expenses', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('expenses.create'); // Renderiza la vista create.blade.php
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validaciones básicas | Requisito de la actividad
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:500',
            'total' => 'required|numeric|min:0',
            'registered_at' => 'required|date',
        ]);

        // Crear un nuevo gasto asociado al usuario autenticado
        Expense::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'total' => $request->input('total'),
            'registered_at' => $request->input('registered_at'),
            'user_id' => auth()->id(),
        ]);

        // Redirige al listado de gastos con un mensaje de éxito
        return redirect()->route('expenses.index')->with('success', 'Gasto registrado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total' => 'required|numeric|min:0',
            'registered_at' => 'required|date',
        ]);

        $expense->update([
            'title' => $request->title,
            'description' => $request->description,
            'total' => $request->total,
            'registered_at' => $request->registered_at,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Gasto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Gasto eliminado correctamente.');
    }

    public function togglePaid(Expense $expense)
    {
        $expense->paid = !$expense->paid; // Alternar entre pagado/no pagado
        $expense->save();

        return redirect()->route('expenses.index')->with('status', 'Estado de gasto actualizado.');
    }
}
