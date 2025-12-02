{{-- resources/views/abonados/index.blade.php --}}
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Listado de Abonados
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      {{-- Controles: Nuevo, Buscar, Filtrar y Volver --}}
      <div class="flex flex-col md:flex-row md:items-center md:space-x-4 mb-4">
        
        {{-- Nuevo Abonado --}}
        <a
          href="{{ route('abonados.create') }}"
          class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 mb-2 md:mb-0 flex items-center space-x-2"
        >
          {{-- Icono Plus --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
          </svg>
          <span>Nuevo Abonado</span>
        </a>

        {{-- Buscador y filtro --}}
        <form method="GET" action="{{ route('abonados.index') }}" class="flex-1 flex flex-wrap gap-2">
          <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Buscar por nombre, apellido o CI..."
            class="w-full md:w-1/3 px-3 py-2 border rounded"
          >
          <select
            name="estado"
            class="px-3 py-2 border rounded"
          >
            <option value="">Todos los estados</option>
            <option value="activo"   {{ request('estado')=='activo'   ? 'selected' : '' }}>Activos</option>
            <option value="inactivo" {{ request('estado')=='inactivo' ? 'selected' : '' }}>Inactivos</option>
          </select>
          <button
            type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 flex items-center space-x-2"
          >
            {{-- Icono Search --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <span>Filtrar</span>
          </button>
        </form>

        {{-- Volver al dashboard --}}
        <a
          href="{{ route('dashboard') }}"
          class="mt-2 md:mt-0 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 flex items-center space-x-2"
        >
          {{-- Icono Arrow Left --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
          <span>Volver</span>
        </a>
      </div>

      {{-- Mensajes de éxito --}}
      @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded">
          {{ session('success') }}
        </div>
      @endif

      {{-- Tabla de abonados --}}
      <div class="bg-white shadow overflow-hidden sm:rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CI</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Zona</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse($abonados as $abonado)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $abonado->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $abonado->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $abonado->apellido }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $abonado->ci }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $abonado->telefono1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $abonado->zona }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  <span class="px-2 py-1 rounded text-xs {{ $abonado->estado == 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ ucfirst($abonado->estado) }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                  {{-- Editar datos personales --}}
                  <a href="{{ route('abonados.edit', $abonado) }}"
                     class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500"
                     aria-label="Editar datos personales">
                    ✏️
                  </a>

                  {{-- Agregar o editar datos técnicos --}}
                  @if($abonado->datosTecnico)
                    <a href="{{ route('datos_tecnicos.edit', $abonado->datosTecnico) }}"
                       class="px-2 py-1 bg-indigo-400 text-white rounded hover:bg-indigo-500"
                       aria-label="Editar datos técnicos">
                      ⚙️
                    </a>
                  @else
                    <a href="{{ route('datos_tecnicos.create', ['abonado_id'=>$abonado->id]) }}"
                       class="px-2 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700"
                       aria-label="Agregar datos técnicos">
                      ➕⚙️
                    </a>
                  @endif

                  {{-- Ver historial --}}
                  <a href="{{ route('abonados.historial', $abonado) }}"
                     class="px-2 py-1 bg-green-600 text-white rounded hover:bg-green-700"
                     aria-label="Ver historial">
                    📜
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center py-6 text-gray-500">
                  No se encontraron abonados.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Paginación --}}
      <div class="mt-6">
        {{ $abonados->links() }}
      </div>

    </div>
  </div>
</x-app-layout>
