<?php

namespace App\Http\Controllers;

use App\Models\Doubt;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class DoubtController extends BaseController
{
    public function index()
    {
        return Doubt::all();
    }

    public function store(Request $request)
    {
        $doubt = Doubt::create($request->all());

        return response()->json($doubt, 201);
    }

    public function show(int $id)
    {
        $doubt = Doubt::find($id);

        return $doubt;
    }

    public function update(int $id, Request $request)
    {
        $doubt = Doubt::find($id);
        if (is_null($doubt)) {
            return response()->json(['erro' => "Dúvida não encontrada: ID {$id}"], 400);
        }

        $doubt->fill($request->all());
        $doubt->save();

        return response()->json($doubt, 204);
    }

    public function destroy(int $id)
    {
        $countDoubt = Doubt::destroy($id);
        if ($countDoubt === 0) {
            return response()->json(['erro' => "Dúvida não encontrada: ID {$id}"], 400);
        }

        return response()->json('', 204);
    }
}
