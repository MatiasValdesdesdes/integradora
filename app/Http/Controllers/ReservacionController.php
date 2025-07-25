<?php

namespace App\Http\Controllers;

use App\Models\Reservacion;
use Illuminate\Http\Request;

class ReservacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reservaciones.index'); // Plural (usa el namespace configurado)
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservaciones.create'); // Plural
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Redirige al index después de creación exitosa
        return redirect()->route('reservaciones.index')
               ->with('success', 'Reservación creada exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservacion $reservacion)
    {
        return view('reservaciones.show', [ // Plural
            'reservacion' => $reservacion,
            'user' => auth()->user() // Ejemplo de dato adicional
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservacion $reservacion)
    {
        return view('reservaciones.edit', [ // Plural
            'reservacion' => $reservacion,
            'horarios_disponibles' => $this->getHorariosDisponibles() // Ejemplo de método helper
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservacion $reservacion)
    {
        // Redirige al index después de actualización
        return redirect()->route('reservaciones.index')
               ->with('success', 'Reservación actualizada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservacion $reservacion)
    {
        $reservacion->delete();
        
        return redirect()->route('reservaciones.index')
               ->with('success', 'Reservación eliminada exitosamente!');
    }

    /**
     * Obtiene horarios disponibles para reservaciones
     */
    protected function getHorariosDisponibles(): array
    {
        return [
            '12:00', '13:00', '14:00',
            '19:00', '20:00', '21:00'
        ];
    }
}