<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Muestra una lista de todos los usuarios.
     */
        public function index(Request $request)
    {
        // Número de elementos por página, con valor por defecto de 5
        $perPage = $request->input('per_page', 5);
        
        // Opcional: añadir filtros básicos
        $query = User::query();
        
        // Ejemplo de filtro por nombre si se envía en la request
        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('email', 'like', '%' . $request->input('search') . '%');
        }
    
        // Ordenamiento opcional
        $sortBy = $request->input('sort_by', 'id_usuario'); // Campo por defecto
        $sortDirection = $request->input('sort_direction', 'asc'); // Dirección por defecto
        $query->orderBy($sortBy, $sortDirection);
    
        // Seleccionar solo los campos necesarios (optimización)
        $query->select('id_usuario', 'nombre', 'app', 'apm', 'fn', 'telefono', 'email');
    
        // Obtener los usuarios paginados
        $users = $query->paginate($perPage);
    
        // Mantener los parámetros de la URL en los enlaces de paginación
        $users->appends($request->except('page'));
    
        return view('admin.users.index', compact('users'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return view('admin.users.create'); // Retorna la vista para crear un usuario
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // Valida los datos ingresados en el formulario
        $request->validate([
            'nombre' => 'required',
            'app' => 'required',
            'apm' => 'required',
            'fn' => 'required|date', // Debe ser una fecha válida
            'telefono' => 'required',
            'email' => 'required|email', // Debe ser un email válido
            'password' => 'required',
        ]);

        // Crea el usuario en la base de datos
        User::create([
            'nombre' => $request->nombre,
            'app' => $request->app,
            'apm' => $request->apm,
            'fn' => $request->fn,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encripta la contraseña antes de guardarla
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Muestra un usuario específico.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user')); // Retorna la vista con los detalles del usuario
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user')); // Retorna la vista de edición con los datos del usuario
    }

    /**
     * Actualiza un usuario en la base de datos.
     */
    public function update(Request $request, User $user)
    {
        // Valida los datos ingresados en el formulario
        $request->validate([
            'nombre' => 'required',
            'app' => 'required',
            'apm' => 'required',
            'fn' => 'required|date',
            'telefono' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:8', // La contraseña es opcional, pero si se ingresa debe tener mínimo 8 caracteres
        ]);

        // Obtiene los datos excepto la contraseña
        $data = $request->except('password');

        // Si el usuario ingresó una nueva contraseña, se encripta y se actualiza
        if ($request->has('password') && $request->password != null) {
            $data['password'] = bcrypt($request->password);
        } else {
            $data['password'] = $user->password; // Mantiene la contraseña actual si no se ingresa una nueva
        }

        // Actualiza el usuario con los nuevos datos
        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Elimina un usuario de la base de datos.
     */
    public function destroy(User $user)
    {
        $user->delete(); // Elimina el usuario
        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente');
    }
}

