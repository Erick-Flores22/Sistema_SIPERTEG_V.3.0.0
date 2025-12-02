<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      Crear Nuevo Usuario
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-md mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
        <form method="POST" action="{{ route('users.store') }}">
          @csrf

          {{-- Nombre --}}
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          {{-- Email --}}
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          {{-- Contraseña --}}
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
            <input type="password" name="password" class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          {{-- Rol --}}
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rol</label>
            <select name="role" class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
              <option value="">Seleccione un rol</option>
              <option value="admin">Administrador</option>
              <option value="cobrador">Cobrador</option>
              <option value="tecnico">Técnico</option>
              <option value="tecnico">Asistente</option>
            </select>
            @error('role') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          {{-- Botones --}}
          <div class="flex justify-end space-x-3">
            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Crear</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
