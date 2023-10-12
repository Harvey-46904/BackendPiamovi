<?php

namespace App\Http\Controllers;

use App\Models\Conductores;
use Illuminate\Http\Request;

class ConductoresController extends Controller
{
    public function index()
    {
        $conductores = Conductores::all();
        return response()->json($conductores);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'modelo_vehiculo' => 'required|string',
            'placa_vehiculo' => 'required|string|unique:conductores',
            'calificaciones' => 'required|numeric',
        ]);

        $conductor = new Conductores([
            'nombre' => $request->input('nombre'),
            'modelo_vehiculo' => $request->input('modelo_vehiculo'),
            'placa_vehiculo' => $request->input('placa_vehiculo'),
            'calificaciones' => $request->input('calificaciones'),
        ]);

        $conductor->save();

        return response()->json($conductor, 201);
    }

    public function show($id)
    {
        $conductor = Conductores::find($id);

        if (!$conductor) {
            return response()->json(['message' => 'Conductores no encontrado'], 404);
        }

        return response()->json($conductor);
    }

    public function update(Request $request, $id)
    {
        $conductor = Conductores::find($id);

        if (!$conductor) {
            return response()->json(['message' => 'Conductores no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'required|string',
            'modelo_vehiculo' => 'required|string',
            'placa_vehiculo' => 'required|string|unique:conductores,placa_vehiculo,' . $conductor->id,
            'calificaciones' => 'required|numeric',
        ]);

        $conductor->nombre = $request->input('nombre');
        $conductor->modelo_vehiculo = $request->input('modelo_vehiculo');
        $conductor->placa_vehiculo = $request->input('placa_vehiculo');
        $conductor->calificaciones = $request->input('calificaciones');

        $conductor->save();

        return response()->json($conductor, 200);
    }

    public function destroy($id)
    {
        $conductor = Conductores::find($id);

        if (!$conductor) {
            return response()->json(['message' => 'Conductores no encontrado'], 404);
        }

        $conductor->delete();

        return response()->json(['message' => 'Conductores eliminado'], 200);
    }
}
