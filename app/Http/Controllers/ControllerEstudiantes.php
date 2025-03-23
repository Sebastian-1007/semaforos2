<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ControllerEstudiantes extends Controller
{

    public function getEstu(Request $request)
    {
        // Hacemos una solicitud GET a la API externa
        $response = Http::get('http://3.85.62.21:3000/sistema/semaforo_estudiantes/');
    
        if ($response->successful()) {
            $data = $response->json(); // Convierte la respuesta JSON en un array
            $collection = collect($data); // Convertimos el array en una colección
    
            // Número de elementos por página, con valor por defecto de 5
            $perPage = $request->input('per_page', 5);
            $currentPage = $request->input('page', 1);
    
            // Aplicar filtro de búsqueda si existe
            if ($request->filled('search')) {
                $search = strtolower($request->input('search'));
                $collection = $collection->filter(function ($item) use ($search) {
                    return stripos($item['Numero_Cambios'], $search) !== false ||
                           stripos($item['Fecha'], $search) !== false ||
                           stripos($item['Hora'], $search) !== false;
                });
            }
    
            // Ordenamiento opcional
            $sortBy = $request->input('sort_by', 'Id_semaforo_estu'); // Campo por defecto
            $sortDirection = $request->input('sort_direction', 'asc'); // Dirección por defecto
    
            $collection = $collection->sortBy([
                [$sortBy, $sortDirection]
            ]);
    
            // División manual de la colección en páginas
            $currentItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
    
            // Crear paginador manualmente
            $Estu = new LengthAwarePaginator(
                $currentItems,
                $collection->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
    
            return view('estudiantes.registro_estudiantes', compact('Estu'));
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }
    
    ///////////////////////////////////

    public function getEstu1($Id_semaforo_estu){
        // Hacemos una solicitud GET a una API externa
        $response = Http::get('http://3.85.62.21:3000/sistema/semaforo_estudiantes/'. $Id_semaforo_estu);

        // Verificamos si la solicitud fue exitosa
        if ($response->successful()) {
            $Estu1 = $response->json(); // Obtiene los datos en formato JSON


            return view('estudiantes.detalle_estudiantes', compact('Estu1')); // Pasamos los datos a una vista
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }

    ///////////////////////////////////FORMULARIO
    public function create()
    {
        // Obtener los grupos desde la API
        $Estu = Http::get('http://3.85.62.21:3000/sistema/semaforo_estudiantes/')->json();

        return view('estudiantes.estudiantes_login', compact('Estu'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'Numero_Cambios' => 'required',
            'Fecha' => 'required',
            'Hora' => 'required'
        ]);

        $response = Http::post('http://3.85.62.21:3000/sistema/semaforo_estudiantes/', [
            'Numero_Cambios' => $request->Numero_Cambios,
            'Fecha' => $request->Fecha,
            'Hora' => $request->Hora,   
        ]);

        if ($response->successful()) {
            return redirect()->route('estudiantes.registro_estudiantes')->with('success', 'Alumno registrado correctamente');
        }

        return back()->with('error', 'Error al registrar el alumno');
    }

    //////////////////////////////////
    public function edit($Id_semaforo_estu)
    {
    // Obtener los datos del sensor desde la API
    $response = Http::get("http://3.85.62.21:3000/sistema/semaforo_estudiantes/{$Id_semaforo_estu}");

    if ($response->successful()) {
        $Estu = $response->json();
        return view('estudiantes.editar_estudiantes', compact('Estu'));
    }

    return back()->with('error', 'No se pudo obtener la información del sensor');
   }

   public function update(Request $request, $Id_semaforo_estu)
    {
    $request->validate([
        'Numero_Cambios' => 'required',
        'Fecha' => 'required|date',
        'Hora' => 'required',
    ]);

    // Datos a enviar en la petición PUT
    $Estu = [
        'Numero_Cambios' => $request->Numero_Cambios,
        'Fecha' => $request->Fecha,
        'Hora' => $request->Hora,
    ];

    // Enviar datos a la API
    $response = Http::put("http://3.85.62.21:3000/sistema/semaforo_estudiantes/{$Id_semaforo_estu}", $Estu);

    if ($response->successful()) {
        return redirect()->route('estudiantes.registro_estudiantes')->with('success', 'Datos actualizados correctamente');
    }

    return back()->with('error', 'Error al actualizar los datos');
    }

    
    //////////////////////
    public function deleteEstu($Id_semaforo_estu)
    {
        // Agrega una barra antes del ID para formar una URL válida
        $response = Http::delete('http://3.85.62.21:3000/sistema/semaforo_estudiantes/' . $Id_semaforo_estu);
    
        if ($response->successful()) {
            return redirect()->route('estudiantes.registro_estudiantes')->with('success', 'Recurso eliminado correctamente');
        } else {
            return redirect()->route('estudiantes.registro_estudiantes')->with('error', 'Error al eliminar el recurso');
        }
    }
    
}
