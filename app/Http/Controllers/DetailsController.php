<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Doubt;
use Laravel\Lumen\Routing\Controller as BaseController;

class DetailsController extends BaseController
{
    public function show(int $id)
    {
        $doubt = Doubt::find($id);
        if (is_null($doubt)) {
            return response()->json([
                'erro' => 'Recurso não encontrado'
            ], 404);
        }

        $answer = Answer::query()
            ->where('pergunta_id', $id)
            ->paginate();

        $data = [
            'duvida' => $doubt,
            'respostas' => $answer
        ];

        return response()->json($data, 200);
    }
}
