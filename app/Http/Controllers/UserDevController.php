<?php

namespace App\Http\Controllers;

use App\Models\UserDev;
use Illuminate\Http\Request;

class UserDevController extends BaseController
{
    public function __construct()
    {
        $this->class = UserDev::class;
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
