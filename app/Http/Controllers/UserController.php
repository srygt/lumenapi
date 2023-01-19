<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function showAll()
    {
        return response()->json(User::all());
    }

    public function show($id)
    {
        return response()->json(User::find($id));
    }

    public function save(Request $request)
    {
        $user = new User([
            "name"          => $request->get('name'),
            "surname"       => $request->get('surname'),
            "username"      => $request->get('username'),
            "email"         => $request->get('email'),
            "gender"        => $request->get('gender'),
            "checked"       => $request->get('checked'),
            "password"      => Hash::make($request->get('password')),
            "status"        => $request->get('status')
        ]);
        $user->save();        
        //$user = User::create($request->all());
        return response()->json($user);
    }

    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id)->delete();
        return response()->json("Üye Silindi...");
    }
}