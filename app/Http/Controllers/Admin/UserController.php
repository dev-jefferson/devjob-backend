<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidation;
use App\models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(UserValidation $request)
    {
        $request->validated();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->contacts = $request->contacts;
        $user->addresses = $request->addresses;
        $user->linkedin = $request->linkedin;
        $user->git = $request->git;
        $user->save();

        return response()->json([
            'success' => 'Usuário criado com sucesso!',
            'data' => $user,
        ], 201);
    }



    public function show($id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['error' => 'Usuário não encontrado!'], 404);
        }
        return response()->json($user);
    }



    public function update(UserValidation $request, User $user)
    {

        $request->validated();

        $user->update($request->all());

        return response()->json([
            'success' => 'Usuário alterado com sucesso!',
            'data' => $user,
        ], 200);
    }



    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['error' => 'Usuário não encontrado!'], 404);
        }
        $user->delete();

        return response()->json(['success' => 'Usuário removido com sucesso!'], 200);
    }
}
