<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct()

    {
        //protegemos las URL y con except hacemos excepciones para que esas paginas si se puedan ver
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user){

        $posts = Post::where('user_id', $user->id)->latest()->paginate(6);

       
      
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create(){

        return view('post.create');
    }


    public function store(Request $request){

       $this->validate($request, [
        'titulo' => 'required|max:255',
        'descripcion' => 'required',
        'imagen' => 'required'
       ]);

       //Crear un registro

      // Post::create([
      //  'titulo' => $request->titulo,
      //  'descripcion' => $request->descripcion,
      //  'imagen' => $request->imagen,
      //  'user_id' => auth()->user()->id
      // ]);


       //otra forma de crear un registro con relaciones
       $request->user()->posts()->create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'imagen' => $request->imagen,
        'user_id' => auth()->user()->id
       ]);
       return redirect()->route('posts.index', ['user' => auth()->user()->username]);
    }

    public function show(User $user, Post $post){

        return view('post.show',[
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post){

        $this->authorize('delete', $post);
        $post->delete();

        //Eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
