@extends('layouts.app')

@section('titulo')
   Perfil: {{$user->username}}
@endsection

@section('contenido')
    
<div class="flex justify-center">
    <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
        <div class="w-8/12 lg:w-6/12 px-5">
            <img class=" rounded-full" src="{{$user->imagen ? asset('perfiles'). '/'. $user->imagen : asset('img/usuario.svg')}}" alt="Imagen Usuario">
        </div>
        <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start py-10 md:py-10 md:justify-center ">
            <div class="flex items-center gap-2">
                <p class="text-gray-700 text-2xl">{{$user->username}}</p>

                 @auth
                     @if ($user->id === auth()->user()->id)
                     <a href="{{route('perfil.index')}}" class="text-gray-500  hover:text-gray-600 cursor-pointer ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                     </a>
                     @endif
                 @endauth
         </div>

         <livewire:datos-perfil :user="$user" />
           
 
            <p class="text-gray-800 text-sm mb-3 font-bold">{{$user->posts->count()}}
                <span class="font-normal">Post</span>
            </p>

            @auth
            @if ($user->id !== auth()->user()->id)
              @if (!$user->siguiendo(auth()->user()))
           
                <form action="{{route('users.follower', $user)}}" method="POST">
                    @csrf
                    <button class="flex gap-2 font-medium bg-blue-600 rounded-lg px-2 py-1 text-white" type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                      </svg> Seguir
                      </button>
                </form>
            @else
                <form action="{{route('users.unfollower', $user)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="flex gap-2 font-medium bg-red-600 rounded-lg px-2 py-1 text-white" type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                      </svg> Dejar de Seguir
                      </button>
                </form>
                @endif
            @endif
            @endauth
        </div>
    </div>
</div>



<section class="container mx-auto mt-10">
    <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

    <x-listar-post :posts="$posts"/>
    
</section>
@endsection

