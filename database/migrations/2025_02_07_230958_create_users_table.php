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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario'); // Define la clave primaria con autoincremento y el nombre 'id_usuario'
            $table->string('nombre'); // Campo para almacenar el nombre del usuario (VARCHAR)
            $table->string('app'); // Apellido paterno
            $table->string('apm'); // Apellido materno
            $table->date('fn'); // Fecha de nacimiento (DATE)
            $table->string('telefono'); // Número de teléfono del usuario
            $table->string('email')->unique(); // Correo electrónico (debe ser único en la tabla)
            $table->string('password'); // Contraseña del usuario
            $table->timestamps(); // Agrega automáticamente los campos 'created_at' y 'updated_at'
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
