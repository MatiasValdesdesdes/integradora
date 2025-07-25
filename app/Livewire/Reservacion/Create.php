<?php

namespace App\Http\Livewire\Reservacion;

use Livewire\Component;
use App\Models\Reservacion;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $nombre_cliente;
    public $fecha_reserva;
    public $hora_reserva = '19:00';
    public $numero_personas = 2;
    public $telefono;
    public $email;
    public $comentarios;

    protected $rules = [
        'nombre_cliente' => 'required|min:3|max:50',
        'fecha_reserva' => 'required|date|after_or_equal:today',
        'hora_reserva' => 'required',
        'numero_personas' => 'required|integer|min:1|max:20',
        'telefono' => 'required|digits:10',
        'email' => 'nullable|email',
        'comentarios' => 'nullable|max:255'
    ];

    public function save()
    {
        $this->validate();

        Reservacion::create([
            'nombre_cliente' => $this->nombre_cliente,
            'fecha_reserva' => $this->fecha_reserva,
            'hora_reserva' => $this->hora_reserva,
            'numero_personas' => $this->numero_personas,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'comentarios' => $this->comentarios,
            'user_id' => Auth::id()
        ]);

        session()->flash('message', 'Reservación creada exitosamente!');
        return redirect()->to('/reservaciones');
    }

    public function render()
    {
        return view('livewire.reservacion.create');
    }
}