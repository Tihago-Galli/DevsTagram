@extends('layouts.app')

@section('titulo')

Editar Perfil: {{auth()->user()->username}}
@endsection


@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{route('perfil.store')}}" enctype="multipart/form-data" class="mt-10 md:mt-0" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" id="username" name="username" value="{{auth()->user()->username}}" placeholder="Tu Username" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror">
                    @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" id="email" name="email" value="{{auth()->user()->email}}" placeholder="Nuevo Email" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror">
                    @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfil</label>
                    <input type="file" id="imagen" accept=".jpg, .jpeg, .png" name="imagen" class="border p-3 w-full rounded-l">
                    @error('imagen')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
                </div>

                <fieldset>
                    <legend class="font-bold uppercase text-gray-700 pt-5 mb-5 border-b-2">Cambiar Password</legend>
                    
                    <div class="mb-5">
                        <label for="old_password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                        <input type="password" id="old_password" name="old_password" placeholder="Contraseña actual" class="border p-3 w-full rounded-lg @error('old_password') border-red-500 @enderror"">
                        @if (session('mensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{session('mensaje')}}</p>
                        @endif
                    </div>
                
                    <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Nueva Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Nueva Contraseña" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"">
                    @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir Nueva Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite tu nueva Contraseña" class="border p-3 w-full rounded-lg @error('password2') border-red-500 @enderror">
                    @error('password2')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">Debes repetir la contraseña</p>
                    @enderror
                </div>
            </fieldset>
                <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase text-white p-3 font-bold w-full rounded-lg">
            </form>
        </div>
    </div>
@endsection