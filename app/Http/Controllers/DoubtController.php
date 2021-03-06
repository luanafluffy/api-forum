<?php

namespace App\Http\Controllers;

use App\Models\Doubt;
use Illuminate\Http\Request;

class DoubtController extends BaseController
{
    public function __construct()
    {
        $this->class = Doubt::class;
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
