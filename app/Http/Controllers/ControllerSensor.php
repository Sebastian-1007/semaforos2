<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ControllerSensor extends Controller
{
   
    public function getSensor(Request $request)
    {
        // Hacemos una solicitud GET a la API externa
        $response = Http::get('http://3.85.62.21:3000/sistema/sensor_presencia/');
    
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
                    return stripos($item['Numero_Estudiantes'], $search) !== false ||
                           stripos($item['Fecha'], $search) !== false ||
                           stripos($item['Hora'], $search) !== false;
                });
            }
    
            // Ordenamiento opcional
            $sortBy = $request->input('sort_by', 'Id_sensor'); // Campo por defecto
            $sortDirection = $request->input('sort_direction', 'asc'); // Dirección por defecto
    
            $collection = $collection->sortBy([
                [$sortBy, $sortDirection]
            ]);
    
            // División manual de la colección en páginas
            $currentItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
    
            // Crear paginador manualmente
            $Sensor = new LengthAwarePaginator(
                $currentItems,
                $collection->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
    
            return view('sensor.registro_sensor', compact('Sensor'));
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }
    
//////////////////////

    public function getSensor1($Id_sensor){
        // Hacemos una solicitud GET a una API externa
        $response = Http::get('http://3.85.62.21:3000/sistema/sensor_presencia/'. $Id_sensor);

        // Verificamos si la solicitud fue exitosa
        if ($response->successful()) {
            $Sensor1 = $response->json(); // Obtiene los datos en formato JSON

            //return view('getData2')->with(['data' => $data]);

            return view('sensor.detalle_sensor', compact('Sensor1')); // Pasamos los datos a una vista
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }

    ///////////////////////////////////FORMULARIO
    public function create()
    {
        // Obtener los grupos desde la API
        $Sensor = Http::get('http://3.85.62.21:3000/sistema/sensor_presencia/')->json();

        return view('sensor.sensor_login', compact('Sensor'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'Numero_Estudiantes' => 'required',
            'Fecha' => 'required',
            'Hora' => 'required'
        ]);

        $response = Http::post('http://3.85.62.21:3000/sistema/sensor_presencia/', [
            'Numero_Estudiantes' => $request->Numero_Estudiantes,
            'Fecha' => $request->Fecha,
            'Hora' => $request->Hora,   
        ]);

        if ($response->successful()) {
            return redirect()->route('sensor.registro_sensor')->with('success', 'Alumno registrado correctamente');
        }

        return back()->with('error', 'Error al registrar el alumno');
    }

    //////////////////////////////////
    public function edit($Id_sensor)
    {
    // Obtener los datos del sensor desde la API
    $response = Http::get("http://3.85.62.21:3000/sistema/sensor_presencia/{$Id_sensor}");

    if ($response->successful()) {
        $Sensor = $response->json();
        return view('sensor.editar_sensor', compact('Sensor'));
    }

    return back()->with('error', 'No se pudo obtener la información del sensor');
   }

   public function update(Request $request, $Id_sensor)
    {
    $request->validate([
        'Numero_Estudiantes' => 'required',
        'Fecha' => 'required|date',
        'Hora' => 'required',
    ]);

    // Datos a enviar en la petición PUT
    $Sensor = [
        'Numero_Estudiantes' => $request->Numero_Estudiantes,
        'Fecha' => $request->Fecha,
        'Hora' => $request->Hora,
    ];

    // Enviar datos a la API
    $response = Http::put("http://3.85.62.21:3000/sistema/sensor_presencia/{$Id_sensor}", $Sensor);

    if ($response->successful()) {
        return redirect()->route('sensor.registro_sensor')->with('success', 'Datos actualizados correctamente');
    }

    return back()->with('error', 'Error al actualizar los datos');
    }

    
    //////////////////////
    public function deleteSensor($Id_sensor)
    {
        // Agrega una barra antes del ID para formar una URL válida
        $response = Http::delete('http://3.85.62.21:3000/sistema/sensor_presencia/' . $Id_sensor);
    
        if ($response->successful()) {
            return redirect()->route('sensor.registro_sensor')->with('success', 'Recurso eliminado correctamente');
        } else {
            return redirect()->route('sensor.registro_sensor')->with('error', 'Error al eliminar el recurso');
        }
    }
    
}
