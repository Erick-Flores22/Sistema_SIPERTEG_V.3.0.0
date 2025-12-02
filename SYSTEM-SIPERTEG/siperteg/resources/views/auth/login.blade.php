{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 dark:bg-gray-900 px-4">
  
  {{-- Logo --}}
  <div class="mb-6">
    <img src="{{ asset('storage/logo_siperteg.png') }}" 
         alt="Logo del sistema"
         class="h-20 w-auto mx-auto rounded-lg shadow-md">
  </div>

  {{-- Card --}}
  <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
    
    <h2 class="text-center text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">
      Iniciar Sesión
    </h2>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
      @csrf

      {{-- Email --}}
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo electrónico</label>
        <input id="email" name="email" type="email" required autofocus
               class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                      focus:ring-2 focus:ring-blue-500 focus:outline-none bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200" />
        @error('email')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Contraseña --}}
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
        <input id="password" name="password" type="password" required
               class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                      focus:ring-2 focus:ring-blue-500 focus:outline-none bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200" />
        @error('password')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Recordarme --}}
      <div class="flex items-center justify-between">
        <label class="inline-flex items-center">
          <input type="checkbox" name="remember" class="rounded text-blue-600 focus:ring-blue-500">
          <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Recuérdame</span>
        </label>
        
      </div>

      {{-- Botón --}}
      <div>
        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
          Entrar
        </button>
      </div>
    </form>
  </div>

  {{-- Pie --}}
  <p class="mt-6 text-sm text-gray-600 dark:text-gray-400">
    © {{ date('Y') }} SIPERTEG — Todos los derechos reservados.
  </p>
</div>
@endsection
