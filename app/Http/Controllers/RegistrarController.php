<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrarController extends Controller
{
    public function index() {
        return view('auth.registrar');
}
public function store(Request $request) {

    //Modificar el Reuest
    $request->request->add(['username' =>  Str::slug($request->username)]);
    
    //Validacion
    $this->validate($request, [
        'name' => 'required|max:30',
        'username' => 'required|unique:users|min:3|max:30',
        'email' => 'required|unique:users|email|max:60',
        'password' => 'required|min:6|confirmed'

    ]);
    
   User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password)
   ]);

   //autenticar el usuario

//   auth()->attempt([
//      'email' => $request->email,
//    'password' => $request->password
//]);

   //Otra forma de autenticar
   auth()->attempt($request->only('email', 'password'));


   //redireccionar
   return redirect()->route('posts.index', ['user' => auth()->user()->username]);



}


}