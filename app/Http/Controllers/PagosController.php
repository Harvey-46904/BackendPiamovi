<?php

namespace App\Http\Controllers;

use App\Models\Pagos;
use Illuminate\Http\Request;

class PagosController extends Controller
{
    public function index()
    {
        $pagos = Pagos::all();
        return response()->json($pagos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'metodo_pago' => 'required|string',
            'saldo' => 'required|numeric',
        ]);

        $pago = new Pagos($request->all());

        $pago->save();

        return response()->json($pago, 201);
    }

    public function show($id)
    {
        $pago = Pagos::find($id);

        if (!$pago) {
            return response()->json(['message' => 'Pagos no encontrado'], 404);
        }

        return response()->json($pago);
    }

    public function update(Request $request, $id)
    {
        $pago = Pagos::find($id);

        if (!$pago) {
            return response()->json(['message' => 'Pagos no encontrado'], 404);
        }

        $request->validate([
            'usuario_id' => 'exists:usuarios,id',
            'metodo_pago' => 'string',
            'saldo' => 'numeric',
        ]);

        $pago->update($request->all());

        return response()->json($pago, 200);
    }

    public function destroy($id)
    {
        $pago = Pagos::find($id);

        if (!$pago) {
            return response()->json(['message' => 'Pagos no encontrado'], 404);
        }

        $pago->delete();

        return response()->json(['message' => 'Pagos eliminado'], 200);
    }
}
