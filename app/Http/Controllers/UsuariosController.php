<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuarios::all();
        return response()->json($usuarios);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'correo' => 'required|email|unique:usuarios',
            'telefono' => 'required|string',
            'saldo' => 'required|numeric',
        ]);

        $usuario = new Usuarios([
            'nombre' => $request->input('nombre'),
            'correo' => $request->input('correo'),
            'telefono' => $request->input('telefono'),
            'saldo' => $request->input('saldo'),
        ]);

        $usuario->save();

        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        $usuario = Usuarios::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuarios no encontrado'], 404);
        }

        return response()->json($usuario);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuarios::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuarios no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'required|string',
            'correo' => 'required|email|unique:usuarios,correo,' . $usuario->id,
            'telefono' => 'required|string',
            'saldo' => 'required|numeric',
        ]);

        $usuario->nombre = $request->input('nombre');
        $usuario->correo = $request->input('correo');
        $usuario->telefono = $request->input('telefono');
        $usuario->saldo = $request->input('saldo');

        $usuario->save();

        return response()->json($usuario, 200);
    }

    public function destroy($id)
    {
        $usuario = Usuarios::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuarios no encontrado'], 404);
        }

        $usuario->delete();

        return response()->json(['message' => 'Usuarios eliminado'], 200);
    }
}
