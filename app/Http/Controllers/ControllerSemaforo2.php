<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ControllerSemaforo2 extends Controller
{
public function getSema2(Request $request)
{
    // Hacemos una solicitud GET a una API externa
    $response = Http::get('http://localhost:3000/sistema/semaforo_vehiculos2/');

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
        $sortBy = $request->input('sort_by', 'Id_semaforo2'); // Campo por defecto
        $sortDirection = $request->input('sort_direction', 'asc'); // Dirección por defecto

        $collection = $collection->sortBy([
            [$sortBy, $sortDirection]
        ]);

        // División manual de la colección en páginas
        $currentItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();

        // Crear paginador manualmente
        $Sema2 = new LengthAwarePaginator(
            $currentItems,
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('semaforo2.registro_semaforo2', compact('Sema2'));
    } else {
        return response()->json(['error' => 'Error al consultar la API'], 500);
    }
}
    ///////////////////////////////////

    public function getSema3($Id_semaforo2){
        // Hacemos una solicitud GET a una API externa
        $response = Http::get('http://localhost:3000/sistema/semaforo_vehiculos2/'. $Id_semaforo2);

        // Verificamos si la solicitud fue exitosa
        if ($response->successful()) {
            $Sema3 = $response->json(); // Obtiene los datos en formato JSON


            return view('semaforo2.detalle_semaforo2', compact('Sema3')); // Pasamos los datos a una vista
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }

    ///////////////////////////////////FORMULARIO
    public function create()
    {
        // Obtener los grupos desde la API
        $Sema2 = Http::get('http://localhost:3000/sistema/semaforo_vehiculos2/')->json();

        return view('semaforo2.semaforo2_login', compact('Sema2'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'Numero_Cambios' => 'required',
            'Fecha' => 'required',
            'Hora' => 'required'
        ]);

        $response = Http::post('http://localhost:3000/sistema/semaforo_vehiculos2/', [
            'Numero_Cambios' => $request->Numero_Cambios,
            'Fecha' => $request->Fecha,
            'Hora' => $request->Hora,   
        ]);

        if ($response->successful()) {
            return redirect()->route('semaforo2.registro_semaforo2')->with('success', 'Alumno registrado correctamente');
        }

        return back()->with('error', 'Error al registrar el alumno');
    }

    //////////////////////////////////
    public function edit($Id_semaforo2)
    {
    // Obtener los datos del sensor desde la API
    $response = Http::get("http://localhost:3000/sistema/semaforo_vehiculos2/{$Id_semaforo2}");

    if ($response->successful()) {
        $Sema2 = $response->json();
        return view('semaforo2.editar_semaforo2', compact('Sema2'));
    }

    return back()->with('error', 'No se pudo obtener la información del sensor');
   }

   public function update(Request $request, $Id_semaforo2)
    {
    $request->validate([
        'Numero_Cambios' => 'required',
        'Fecha' => 'required|date',
        'Hora' => 'required',
    ]);

    // Datos a enviar en la petición PUT
    $Sema2 = [
        'Numero_Cambios' => $request->Numero_Cambios,
        'Fecha' => $request->Fecha,
        'Hora' => $request->Hora,
    ];

    // Enviar datos a la API
    $response = Http::put("http://localhost:3000/sistema/semaforo_vehiculos2/{$Id_semaforo2}", $Sema2);

    if ($response->successful()) {
        return redirect()->route('semaforo2.registro_semaforo2')->with('success', 'Datos actualizados correctamente');
    }

    return back()->with('error', 'Error al actualizar los datos');
    }

    
    //////////////////////
    public function deleteSema2($Id_semaforo2)
    {
        // Agrega una barra antes del ID para formar una URL válida
        $response = Http::delete('http://localhost:3000/sistema/semaforo_vehiculos2/' . $Id_semaforo2);
    
        if ($response->successful()) {
            return redirect()->route('semaforo2.registro_semaforo2')->with('success', 'Recurso eliminado correctamente');
        } else {
            return redirect()->route('semaforo2.registro_semaforo2')->with('error', 'Error al eliminar el recurso');
        }
    }
    
}
