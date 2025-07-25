<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_cliente',
        'fecha_reserva',
        'hora_reserva',
        'numero_personas',
        'telefono',
        'email',
        'comentarios',
        'user_id'
    ];

    protected $dates = ['fecha_reserva'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}