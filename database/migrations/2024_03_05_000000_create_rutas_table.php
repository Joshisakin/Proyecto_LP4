<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rutas', function (Blueprint $table) {
            $table->id();
            $table->string('origen');
            $table->string('destino');
            $table->dateTime('fecha_salida');
            $table->dateTime('fecha_llegada');
            $table->decimal('precio', 10, 2); // Cambiado a 10,2 para mayor precisión
            $table->integer('capacidad')->default(50); // Agregado valor por defecto
            $table->decimal('duracion', 4, 1); // Duración en horas, permite decimales
            $table->text('descripcion')->nullable(); // Hecho nullable
            $table->boolean('estado')->default(true);
            $table->integer('asientos_disponibles');
            $table->string('imagen')->nullable(); // Agregado de la migración anterior
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutas');
    }
};
