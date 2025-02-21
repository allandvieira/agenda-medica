<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    public function index()
    {
        return response()->json(Receita::with('consulta')->get());
    }

    public function store(Request $request)
    {
        $receita = Receita::create($request->all());
        return response()->json($receita, 201);
    }

    public function show($id)
    {
        return response()->json(Receita::with('consulta')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $receita = Receita::findOrFail($id);
        $receita->update($request->all());
        return response()->json($receita);
    }

    public function destroy($id)
    {
        Receita::destroy($id);
        return response()->json(null, 204);
    }
}

