<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function index()
    {
        return response()->json(Consulta::with(['paciente', 'medico'])->get());
    }

    public function store(Request $request)
    {
        $consulta = Consulta::create($request->all());
        return response()->json($consulta, 201);
    }

    public function show($id)
    {
        return response()->json(Consulta::with(['paciente', 'medico'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->update($request->all());
        return response()->json($consulta);
    }

    public function destroy($id)
    {
        Consulta::destroy($id);
        return response()->json(null, 204);
    }
}
