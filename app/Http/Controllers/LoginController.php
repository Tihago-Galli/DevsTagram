<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
       
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //con remember podemos mantener la sesion abierta
        if(!auth()->attempt($request->only('email', 'password'),$request->remember)){
            //back vuelve a la ventana anterior y con with mostramos un mensaje
            return back()->with('mensaje', 'Credenciales Incorrectas');
        } 
        //redirect redirecciona       
        return redirect()->route('posts.index', ['user' => auth()->user()->username]);
    }
}
