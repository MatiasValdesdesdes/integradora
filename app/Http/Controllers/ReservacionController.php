<?php

namespace App\Http\Controllers;

use App\Models\Reservacion;
use Illuminate\Http\Request;

class ReservacionController extends Controller
{
    public function index()
    {
        return view('reservaciones.index');
    }

    public function create()
    {
        return view('reservaciones.create');
    }

    public function store(Request $request)
    {
        // La validación se maneja en el Livewire Component
    }

    public function show(Reservacion $reservacion)
    {
        return view('reservaciones.show', compact('reservacion'));
    }

    public function edit(Reservacion $reservacion)
    {
        return view('reservaciones.edit', compact('reservacion'));
    }

    public function update(Request $request, Reservacion $reservacion)
    {
        // La validación se maneja en el Livewire Component
    }

    public function destroy(Reservacion $reservacion)
    {
        $reservacion->delete();
        return redirect()->route('reservaciones.index')->with('message', 'Reservación eliminada exitosamente!');
    }
}