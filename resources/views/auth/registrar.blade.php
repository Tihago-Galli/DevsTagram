@extends('layouts.app');

@section('titulo')
Registrate en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
           <img src="{{asset('img/registrar.jpg')}}" alt="Imagen Registro de Usuario">
        </div>
        <div class="md:w-4/12 bg-white p-6 shadow-lg rounded-lg ">
        <form action="{{route('registrar')}}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                <input type="text" id="name" name="name" value="{{old('name')}}" placeholder="Tu Nombre" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                <input type="text" id="username" name="username" value="{{old('username')}}" placeholder="Tu Nombre de Usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror">
                @error('username')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
            @enderror
            </div>
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="Tu Email" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror">
                @error('email')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
            @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                <input type="password" id="password" name="password" placeholder="Tu Contraseña" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"">
                @error('password')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
            @enderror
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite tu Contraseña" class="border p-3 w-full rounded-lg @error('password2') border-red-500 @enderror"">
                @error('password2')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">Debes repetir la contraseña</p>
            @enderror
            </div>
            <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase text-white p-3 font-bold w-full rounded-lg">
        </form>
        </div>
    </div>
@endsection