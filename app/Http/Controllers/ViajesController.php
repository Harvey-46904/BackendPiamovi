<?php

namespace App\Http\Controllers;

use App\Models\Viajes;
use Illuminate\Http\Request;

class ViajesController extends Controller
{
    public function index()
    {
        $viajes = Viajes::all();
        return response()->json($viajes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'conductor_id' => 'required|exists:conductores,id',
            'pasajero_id' => 'required|exists:usuarios,id',
            'ubicacion_recogida' => 'required|string',
            'ubicacion_destino' => 'required|string',
            'hora_inicio' => 'required|date',
            'hora_finalizacion' => 'date',
            'costo' => 'required|numeric',
            'distancia' => 'required|numeric',
            'estado' => 'required|string',
        ]);

        $viaje = new Viajes($request->all());

        $viaje->save();

        return response()->json($viaje, 201);
    }

    public function show($id)
    {
        $viaje = Viajes::find($id);

        if (!$viaje) {
            return response()->json(['message' => 'Viajes no encontrado'], 404);
        }

        return response()->json($viaje);
    }

    public function update(Request $request, $id)
    {
        $viaje = Viajes::find($id);

        if (!$viaje) {
            return response()->json(['message' => 'Viajes no encontrado'], 404);
        }

        $request->validate([
            'conductor_id' => 'exists:conductores,id',
            'pasajero_id' => 'exists:usuarios,id',
            'ubicacion_recogida' => 'string',
            'ubicacion_destino' => 'string',
            'hora_inicio' => 'date',
            'hora_finalizacion' => 'date',
            'costo' => 'numeric',
            'distancia' => 'numeric',
            'estado' => 'string',
        ]);

        $viaje->update($request->all());

        return response()->json($viaje, 200);
    }

    public function destroy($id)
    {
        $viaje = Viajes::find($id);

        if (!$viaje) {
            return response()->json(['message' => 'Viajes no encontrado'], 404);
        }

        $viaje->delete();

        return response()->json(['message' => 'Viajes eliminado'], 200);
    }
}
