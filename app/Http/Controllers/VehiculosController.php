<?php

namespace App\Http\Controllers;

use App\Models\Vehiculos;
use Illuminate\Http\Request;

class VehiculosController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculos::all();
        return response()->json($vehiculos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'capacidad' => 'required|integer',
            'conductor_id' => 'required|exists:conductores,id',
        ]);

        $vehiculo = new Vehiculos($request->all());

        $vehiculo->save();

        return response()->json($vehiculo, 201);
    }

    public function show($id)
    {
        $vehiculo = Vehiculos::find($id);

        if (!$vehiculo) {
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }

        return response()->json($vehiculo);
    }

    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculos::find($id);

        if (!$vehiculo) {
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }

        $request->validate([
            'tipo' => 'string',
            'capacidad' => 'integer',
            'conductor_id' => 'exists:conductores,id',
        ]);

        $vehiculo->update($request->all());

        return response()->json($vehiculo, 200);
    }

    public function destroy($id)
    {
        $vehiculo = Vehiculos::find($id);

        if (!$vehiculo) {
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }

        $vehiculo->delete();

        return response()->json(['message' => 'Vehículo eliminado'], 200);
    }
}
