{{-- resources/views/auth/captcha.blade.php --}}
@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 dark:bg-gray-900 px-4">

  {{-- Tarjeta principal --}}
  <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
    
    {{-- Encabezado --}}
    <h2 class="text-center text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">
      Verificación CAPTCHA
    </h2>

    <form method="POST" action="{{ route('captcha.validate') }}" class="space-y-6">
      @csrf

      {{-- Imagen CAPTCHA con botón recargar --}}
      <div class="flex flex-col items-center space-y-3">
        <div class="flex items-center space-x-3">
          <img
            id="captcha-img"
            src="{{ route('captcha.image') }}?r={{ random_int(0, 10000) }}"
            alt="Captcha"
            class="border border-gray-300 dark:border-gray-600 rounded-md shadow-sm h-12 w-36 object-cover"
          >
          <button
            type="button"
            onclick="document.getElementById('captcha-img').src='{{ route('captcha.image') }}?r='+Math.random()"
            class="px-3 py-2 text-sm font-medium bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition"
          >
            🔄 Recargar
          </button>
        </div>

        {{-- Mensaje de ayuda --}}
        <p class="text-xs text-gray-500 dark:text-gray-400 text-center">
          Escribe el texto que ves en la imagen para continuar
        </p>
      </div>

      {{-- Campo de texto --}}
      <div>
        <label for="captcha" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
          Código de verificación
        </label>
        <input
          id="captcha"
          name="captcha"
          type="text"
          required
          placeholder="Escribe el código aquí"
          class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm 
                 focus:ring-2 focus:ring-blue-500 focus:outline-none 
                 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200"
        >
        @error('captcha')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Botón de envío --}}
      <div>
        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200"
        >
          Verificar
        </button>
      </div>
    </form>
  </div>

  {{-- Pie de página --}}
  <p class="mt-6 text-sm text-gray-600 dark:text-gray-400">
    © {{ date('Y') }} SIPERTEG LTDA — Seguridad y verificación activa.
  </p>
</div>
@endsection
