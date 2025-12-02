<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      📅 Periodos de la gestión {{ $gestion->anio }}
    </h2>
  </x-slot>

  <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
      <table class="min-w-full border divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-100 dark:bg-gray-700">
          <tr>
            <th class="px-4 py-2 text-left">Mes</th>
            <th class="px-4 py-2 text-center">Pagados</th>
            <th class="px-4 py-2 text-center">Pendientes</th>
            <th class="px-4 py-2">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach($periodos as $p)
          <tr>
            <td class="px-4 py-2">{{ $p->mes_nombre }}</td>
            <td class="px-4 py-2 text-center text-green-600">{{ $p->pagados }}</td>
            <td class="px-4 py-2 text-center text-red-600">{{ $p->pendientes }}</td>
            <td class="px-4 py-2 text-center">
              <a href="{{ route('cobros.index', $p) }}"
                 class="text-blue-600 hover:underline">👁 Ver cobros</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>
