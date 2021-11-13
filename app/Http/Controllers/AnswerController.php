<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Doubt;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class AnswerController extends BaseController
{
    public function index()
    {
        return Doubt::all();
    }

    public function store(int $id, Request $request)
    {
        $doubt = Answer::create([
            'comentario' => $request->comentario,
            'usuario_id' => $request->usuario_id,
            'pergunta_id' => $id
        ]);

        return response()->json($doubt, 201);
    }

    public function showByDoubt(int $id)
    {
        $doubt = Doubt::find($id);

        $answer = new Answer();
        $answer = $answer
            ->where('pergunta_id', '=', $id)
            ->get();

        $countAnswer = $answer ? count($answer) : 0;

        $data = [
            'duvida' => $doubt,
            'respostas' => $answer,
            'qtde_respostas' => $countAnswer
        ];

        return response()->json($data, 200);
    }

    public function update(int $id, Request $request)
    {
        $answer = Answer::find($id);
        if (is_null($answer)) {
            return response()->json(['erro' => "Resposta não encontrada: ID {$id}"], 400);
        }

        $answer->fill($request->all());
        $answer->update();

        return response()->json($answer, 204);
    }

    public function destroy(int $id)
    {
        $countAnswers = Answer::destroy($id);
        if ($countAnswers === 0) {
            return response()->json(['erro' => "Resposta não encontrada: ID {$id}"], 400);
        }

        return response()->json('', 204);
    }
}
