<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      📅 Gestiones
    </h2>
  </x-slot>

  <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Listado de gestiones</h3>
        <a href="{{ route('gestiones.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
          ➕ Crear nueva gestión
        </a>
      </div>

      <table class="min-w-full border divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-100 dark:bg-gray-700">
          <tr>
            <th class="px-4 py-2 text-left">Año</th>
            <th class="px-4 py-2 text-left">Periodos</th>
            <th class="px-4 py-2">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach($gestiones as $g)
          <tr>
            <td class="px-4 py-2">{{ $g->anio }}</td>
            <td class="px-4 py-2">{{ $g->periodos_count }}</td>
            <td class="px-4 py-2 text-center">
              <a href="{{ route('periodos.index', $g) }}"
                 class="text-blue-600 hover:underline">👁 Ver periodos</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>
