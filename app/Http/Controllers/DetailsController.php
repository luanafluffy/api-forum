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

        $answer = Doubt::find($id)->answers;

        $countAnswer = $answer ? count($answer) : 0;

        $data = [
            'duvida' => $doubt,
            'respostas' => $answer,
            'qtde_respostas' => $countAnswer
        ];

        return response()->json($data, 200);
    }
}
