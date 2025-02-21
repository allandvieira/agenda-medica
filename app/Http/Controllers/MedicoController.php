<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index()
    {
        return response()->json(Medico::all());
    }

    public function store(Request $request)
    {
        $medico = Medico::create($request->all());
        return response()->json($medico, 201);
    }

    public function show($id)
    {
        return response()->json(Medico::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $medico = Medico::findOrFail($id);
        $medico->update($request->all());
        return response()->json($medico);
    }

    public function destroy($id)
    {
        Medico::destroy($id);
        return response()->json(null, 204);
    }
}
