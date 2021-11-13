<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function show(int $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json('', 204);
        }

        return response()->json($user, 200);
    }

    public function update(int $id, Request $request)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['erro' => "Usuário não encontrado: ID {$id}"], 400);
        }

        $user->fill($request->all());
        $user->save();

        return response()->json($user, 204);
    }

    public function destroy(int $id)
    {
        $countUser = User::destroy($id);
        if ($countUser === 0) {
            return response()->json(['erro' => "Usuário não encontrado: ID {$id}"], 400);
        }

        return response()->json('', 204);
    }
}
