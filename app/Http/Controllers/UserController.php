<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController
{
    protected $class;

    public function __construct()
    {
        $this->class = User::class;
    }

    public function store(Request $request)
    {

        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);

        return response()
            ->json(
                $this->class::create($data),
                201
            );
    }

    public function show(int $id)
    {
        $resource = $this->class::find($id);
        if (is_null($resource)) {
            return response()->json('', 204);
        }

        return response()->json($resource);
    }

    public function destroy(int $id)
    {
        $qtdRecursosRemovidos = $this->class::destroy($id);
        if ($qtdRecursosRemovidos === 0) {
            return response()->json([
                'erro' => 'Recurso não encontrado'
            ], 404);
        }

        return response()->json('', 204);
    }

    public function update(int $id, Request $request)
    {
        $resource = $this->class::find($id);
        if (is_null($resource)) {
            return response()->json([
                'erro' => 'Recurso não encontrado'
            ], 404);
        }
        $resource->fill($request->all());
        $resource->save();

        return $resource;
    }
}
