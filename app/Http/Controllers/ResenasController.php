<?php

namespace App\Http\Controllers;

use App\Models\Resenas;
use Illuminate\Http\Request;

class ResenasController extends Controller
{
    public function index()
    {
        $resenas = Resenas::all();
        return response()->json($resenas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'conductor_id' => 'required|exists:conductores,id',
            'calificacion' => 'required|numeric',
            'comentario' => 'nullable|string',
        ]);

        $resena = new Resenas($request->all());

        $resena->save();

        return response()->json($resena, 201);
    }

    public function show($id)
    {
        $resena = Resenas::find($id);

        if (!$resena) {
            return response()->json(['message' => 'Reseña no encontrada'], 404);
        }

        return response()->json($resena);
    }

    public function update(Request $request, $id)
    {
        $resena = Resenas::find($id);

        if (!$resena) {
            return response()->json(['message' => 'Reseña no encontrada'], 404);
        }

        $request->validate([
            'usuario_id' => 'exists:usuarios,id',
            'conductor_id' => 'exists:conductores,id',
            'calificacion' => 'numeric',
            'comentario' => 'nullable|string',
        ]);

        $resena->update($request->all());

        return response()->json($resena, 200);
    }

    public function destroy($id)
    {
        $resena = Resenas::find($id);

        if (!$resena) {
            return response()->json(['message' => 'Reseña no encontrada'], 404);
        }

        $resena->delete();

        return response()->json(['message' => 'Reseña eliminada'], 200);
    }
}
