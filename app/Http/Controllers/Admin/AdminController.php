<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller; 
use App\Models\Admin; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Auth; 

class AdminController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión para administradores.
     */
    public function loginForm()
    {
        return view('admin.login'); // Retorna la vista del formulario de login
    }

    /**
     * Procesa la solicitud de inicio de sesión del administrador.
     */
    public function login(Request $request)
    {
        // Valida los datos ingresados en el formulario
        $credentials = $request->validate([
            'email' => 'required|email', // El campo email es obligatorio y debe ser un correo válido
            'password' => 'required' // El campo contraseña es obligatorio
        ]);

        // Intenta autenticar al administrador con las credenciales proporcionadas
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard'); // Si es exitoso, redirige al dashboard de admin
        }

        // Si falla la autenticación, regresa con un mensaje de error
        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    /**
     * Muestra el panel de control del administrador.
     */
    public function dashboard()
    {
        return view('admin.dashboard'); // Retorna la vista del dashboard del administrador
    }

    /**
     * Cierra la sesión del administrador y redirige al login.
     */
    public function logout()
    {
        Auth::guard('admin')->logout(); // Cierra la sesión del administrador
        return redirect()->route('admin.login'); // Redirige al formulario de login
    }
}
