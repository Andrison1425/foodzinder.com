<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('email', '!=' , "admin@admin.com")->get();
        return view("users.index", ['users' => $users]);
    }

    public function agregar()
    {
        return view("users.agregar");
    }

    public function crear(Request $request){

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('restaurant.index')->with('Notificacion','Usuario creado exitosamente');

    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view("users.edit", ['user' => $user]);
    }
    public function update(Request $request)
    {
        $user = User::where('id', $request->input('id'))->first();
        $user->profile = $request->input('profile');
        $user->update();

        $users = User::where('email', '!=' , "admin@admin.com")->get();
        return view("users.index", ['users' => $users]);
    }
}
