<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      ➕ Crear gestión
    </h2>
  </x-slot>

  <div class="py-8 max-w-xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
      <form action="{{ route('gestiones.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label for="anio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Año de gestión
          </label>
          <input type="number" name="anio" id="anio"
                 class="w-full border rounded p-2 focus:ring-blue-500 focus:border-blue-500"
                 placeholder="Ej: 2025" required>
          @error('anio')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div class="flex justify-end space-x-2">
          <a href="{{ route('gestiones.index') }}"
             class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancelar</a>
          <button type="submit"
                  class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
