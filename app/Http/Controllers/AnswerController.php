<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends BaseController
{
    public function __construct()
    {
        $this->class = Answer::class;
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
