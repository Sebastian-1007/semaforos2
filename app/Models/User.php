<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory; 
    protected $table = 'usuarios'; // Especifica el nombre de la tabla asociada en la base de datos

    protected $primaryKey = 'id_usuario'; // Define la clave primaria de la tabla

    protected $fillable = [ // Campos que pueden ser asignados en masa (mass assignment)
        'nombre',  // Nombre del usuario
        'app',     // Apellido paterno
        'apm',     // Apellido materno
        'fn',      // Fecha de nacimiento
        'telefono', // Número de teléfono
        'email',   // Correo electrónico
        'password', // Contraseña (será almacenada de forma segura)
    ];

    protected $hidden = [
        'password', // Oculta la contraseña al serializar el modelo para mayor seguridad
    ];
}
