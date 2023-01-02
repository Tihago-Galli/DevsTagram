<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiUsuariosController extends Controller
{
    public function index(){
        $usuarios = User::all();

        echo json_encode($usuarios);
    }
}
