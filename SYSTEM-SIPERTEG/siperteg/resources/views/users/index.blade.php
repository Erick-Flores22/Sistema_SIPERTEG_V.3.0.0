<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      Usuarios Registrados
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Listado de Usuarios</h3>
          <a href="{{ route('users.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Nuevo Usuario</a>
        </div>

        <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
          <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
            <tr>
              <th class="px-6 py-3">Nombre</th>
              <th class="px-6 py-3">Email</th>
              <th class="px-6 py-3">Rol</th>
            </tr>
          </thead>
          <tbody>
            @foreach($usuarios as $u)
              <tr class="border-b dark:border-gray-700">
                <td class="px-6 py-3">{{ $u->name }}</td>
                <td class="px-6 py-3">{{ $u->email }}</td>
                <td class="px-6 py-3 capitalize">{{ $u->role }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>
