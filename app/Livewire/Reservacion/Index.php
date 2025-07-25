<?php

namespace App\Http\Livewire\Reservacion;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservacion;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'fecha_reserva';
    public $sortAsc = true;
    public $selected = []; // Para selección múltiple

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'sortField',
        'sortAsc'
    ];

    protected $listeners = ['refreshReservaciones' => '$refresh'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function confirmDelete($id)
    {
        $this->dispatch('confirmDelete', [
            'id' => $id,
            'message' => '¿Eliminar esta reservación?'
        ]);
    }

    public function delete(Reservacion $reservacion)
    {
        $reservacion->delete();
        $this->dispatch('notify', 'Reservación eliminada');
    }

    public function bulkDelete()
    {
        Reservacion::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        $this->dispatch('notify', 'Reservaciones eliminadas');
    }

    public function render()
    {
        return view('livewire.reservacion.index', [
            'reservaciones' => Reservacion::query()
                ->when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->where('nombre_cliente', 'like', '%'.$this->search.'%')
                          ->orWhere('telefono', 'like', '%'.$this->search.'%')
                          ->orWhere('email', 'like', '%'.$this->search.'%');
                    });
                })
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
        ]);
    }
}