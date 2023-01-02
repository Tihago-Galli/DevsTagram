@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection


@section('contenido')
<a href="{{route('posts.index', auth()->user()->username)}}" class="m-5 w-fit bg-white p-2 px-5 rounded font-bold flex items-center gap-2 hover:bg-gray-200 transition-all ease-in cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
  </svg>
   Volver</a>
<div class="container mx-auto md:flex">
    <div class="md:w-1/2">
        <img src="{{asset('uploads'). '/'. $post->imagen}}" alt="Imagen del post {{$post->titulo}}">
        
        <div class="p-3 flex items-center gap-4">
            @auth
            
                <livewire:like-post :post="$post" />
    
            @endauth
           
        </div>
        <div>
            <p class="font-bold">{{$post->user->username}}</p>
            <p class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>
            <p class="mt-5">{{$post->descripcion}}</p>
        </div>
        @auth
        @if ($post->user_id === auth()->user()->id)
        <form action="{{route('posts.destroy', $post)}}" method="POST">
            @method('DELETE') <!--El metodo Spoofing permite agregar otros metodos como delete, put y path-->
            @csrf
            <input type="submit" value="Eliminar Publicacion" class="bg-red-500 hover:bg-red-600 p-2 rounded text-white cursor-pointer text-center font-bold mt-10">
        </form>
        @endif
      
        @endauth
    </div>

    <div class="md:w-1/2 p-5">
        <div class="shadow bg-white p-5 mb-5">
            @auth       
            <p class="text-xl font-bold text-center mb-4">Agrega un comentario</p>
            @if (session('mensaje'))
                <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                    {{session('mensaje')}}
                </div>
            @endif
            <form action="{{route('comentarios.store', ['post' =>$post, 'user' => $user])}}" method="POST">
              @csrf
                <div class="mb-5">
                    <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade un comentario</label>
                    <textarea name="comentario" id="comentario" placeholder="Agrea un comentario" class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror" ></textarea>
                    @error('comentario')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase text-white p-3 font-bold w-full rounded-lg">
            </form>
            @endauth

            <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario )
                            <div class="p-5 border-gray-300 border-b">
                                <a class="font-bold" href="{{route('posts.index', $comentario->user)}}">{{$comentario->user->username}}</a>
                                <p>{{$comentario->comentario}}</p>
                                <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>
                            </div>
                        @endforeach
                    @else
                    <p class="p-10 text-center">No Hay Comentarios.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection