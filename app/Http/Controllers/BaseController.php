<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController
{
    protected $class;

    public function index(Request $request)
    {
        return $this->class::paginate($request->per_page);
    }

    public function store(Request $request)
    {
        return response()
            ->json(
                $this->class::create($request->all()),
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
}
