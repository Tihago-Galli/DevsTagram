<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public $usuario;

    //creamos la variable de escucha para la funcion de filtar
    protected $listeners = [
        'terminosBusqueda' => 'buscar'
    ];

    public function buscar($usuario){

        $this->usuario = $usuario;
   
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        
        return view('perfil.index');
    }

    public function store(Request $request){

        //Modificar el Request
    $request->request->add(['username' =>  Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required','unique:users,username,' . auth()->user()->id,'min:3','max:30', 'not_in:twitter,editar-perfil'],
            'email' => ['required','unique:users,email,'.auth()->user()->id,'email','max:60'],
          
        ]);


        if($request->old_password){

            if(Hash::check($request->old_password, auth()->user()->password)){
                    $this->validate($request, [
                        'password' => 'required|min:6|confirmed'
                    ]);

                 }else{
                    return back()->with('mensaje', 'Contraseña incorrecta');
                 }
         }


        if($request->imagen){
            $imagen = $request->file('imagen');

            //generamos un nombre unico para cada imagen
            $nombreImagen = Str::uuid() . '.' .  $imagen->extension();
    
            $imagenServidor = Image::make($imagen);
    
            $imagenServidor->fit(1000, 1000);
    
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
    
            $imagenServidor->save($imagenPath);
        }

        //guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        //redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
