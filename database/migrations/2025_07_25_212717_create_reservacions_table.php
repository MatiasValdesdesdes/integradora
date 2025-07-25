<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reservacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cliente', 50);
            $table->date('fecha_reserva');
            $table->time('hora_reserva');
            $table->integer('numero_personas');
            $table->string('telefono', 10);
            $table->string('email')->nullable();
            $table->text('comentarios')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservacions');
    }
};