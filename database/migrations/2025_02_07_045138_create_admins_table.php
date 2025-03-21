<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // Crea un campo id autoincremental como clave primaria
            $table->string('nombre'); // Campo para el nombre del administrador (tipo VARCHAR)
            $table->string('email')->unique(); // Campo para el email (único en la tabla)
            $table->string('password'); // Campo para almacenar la contraseña (tipo VARCHAR)
            $table->timestamps(); // Agrega los campos created_at y updated_at automáticamente
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
        
    }
};
