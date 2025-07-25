<div>
    <div class="container py-4">
        <h2 class="mb-4">Nueva Reservación</h2>
        
        <form wire:submit.prevent="save">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nombre_cliente" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="nombre_cliente" wire:model="nombre_cliente">
                    @error('nombre_cliente') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="telefono" wire:model="telefono">
                    @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="fecha_reserva" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha_reserva" wire:model="fecha_reserva" min="{{ date('Y-m-d') }}">
                    @error('fecha_reserva') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="hora_reserva" class="form-label">Hora</label>
                    <select class="form-select" id="hora_reserva" wire:model="hora_reserva">
                        @foreach(['12:00', '13:00', '14:00', '19:00', '20:00', '21:00'] as $hora)
                            <option value="{{ $hora }}">{{ $hora }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label for="numero_personas" class="form-label">Número de personas</label>
                    <input type="number" class="form-control" id="numero_personas" wire:model="numero_personas" min="1" max="20">
                    @error('numero_personas') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="email" class="form-label">Email (opcional)</label>
                    <input type="email" class="form-control" id="email" wire:model="email">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
                <div class="col-12">
                    <label for="comentarios" class="form-label">Comentarios (opcional)</label>
                    <textarea class="form-control" id="comentarios" wire:model="comentarios" rows="2"></textarea>
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Guardar Reservación</button>
                    <a href="{{ route('reservaciones.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>