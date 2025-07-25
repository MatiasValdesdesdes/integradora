<?php

namespace App\Http\Livewire\Reservacion;

use Livewire\Component;
use App\Models\Reservacion;

class Index extends Component
{
    public $search = '';
    public $perPage = 10;
    public $sortField = 'fecha_reserva';
    public $sortAsc = true;

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.reservacion.index', [
            'reservaciones' => Reservacion::where('nombre_cliente', 'like', '%'.$this->search.'%')
                ->orWhere('telefono', 'like', '%'.$this->search.'%')
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
        ]);
    }
}