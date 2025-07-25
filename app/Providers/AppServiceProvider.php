<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configuración regional para Carbon (fechas)
        Carbon::setLocale(config('app.locale', 'es'));
        
        // Establecer formato de fecha por defecto
        Carbon::setToStringFormat('d/m/Y H:i:s');
        
        // Usar Bootstrap para la paginación (consistente con tu interfaz)
        Paginator::useBootstrapFive();
        
        // Validación personalizada para horarios de reservación
        $this->registerCustomValidations();
        
        // Configuración de alias para vistas de reservaciones (Opción 3)
        View::addNamespace('reservaciones', resource_path('views/reservacion'));
    }
    
    /**
     * Registra validaciones personalizadas para el módulo de reservaciones
     */
    protected function registerCustomValidations(): void
    {
        \Validator::extend('horario_restaurante', function ($attribute, $value, $parameters, $validator) {
            $hora = Carbon::parse($value)->format('H:i');
            $horarioApertura = '12:00';
            $horarioCierre = '22:00';
            
            return $hora >= $horarioApertura && $hora <= $horarioCierre;
        }, 'El horario debe estar entre 12:00 y 22:00 horas');
        
        \Validator::extend('max_personas', function ($attribute, $value, $parameters, $validator) {
            return $value <= 20; // Límite de 20 personas por reservación
        }, 'El número máximo de personas por reservación es 20');
    }
}