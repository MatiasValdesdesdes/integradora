<div>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Listado de Reservaciones</h2>
            <a href="{{ route('reservaciones.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Nueva Reservación
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Buscar..." wire:model="search">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" wire:model="perPage">
                            <option value="5">5 por página</option>
                            <option value="10">10 por página</option>
                            <option value="20">20 por página</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th wire:click="sortBy('nombre_cliente')" style="cursor: pointer;">
                                    Nombre @if($sortField === 'nombre_cliente') @if($sortAsc) ↑ @else ↓ @endif @endif
                                </th>
                                <th wire:click="sortBy('fecha_reserva')" style="cursor: pointer;">
                                    Fecha @if($sortField === 'fecha_reserva') @if($sortAsc) ↑ @else ↓ @endif @endif
                                </th>
                                <th>Hora</th>
                                <th>Personas</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservaciones as $reservacion)
                                <tr>
                                    <td>{{ $reservacion->nombre_cliente }}</td>
                                    <td>{{ $reservacion->fecha_reserva->format('d/m/Y') }}</td>
                                    <td>{{ $reservacion->hora_reserva }}</td>
                                    <td>{{ $reservacion->numero_personas }}</td>
                                    <td>{{ $reservacion->telefono }}</td>
                                    <td>
                                        <a href="{{ route('reservaciones.edit', $reservacion->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button wire:click="confirmDelete({{ $reservacion->id }})" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No hay reservaciones registradas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $reservaciones->links() }}
                </div>
            </div>
        </div>
    </div>
</div>