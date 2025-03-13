<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Foundation\Auth\User as Authenticatable; 
class Admin extends Authenticatable
{
    use HasFactory; 

    protected $table = 'admins'; // Especifica el nombre de la tabla en la base de datos

    protected $fillable = ['nombre', 'email', 'password']; // Define los campos que pueden ser asignados en masa

    protected $hidden = ['password']; // Oculta el campo 'password' al serializar el modelo
}
