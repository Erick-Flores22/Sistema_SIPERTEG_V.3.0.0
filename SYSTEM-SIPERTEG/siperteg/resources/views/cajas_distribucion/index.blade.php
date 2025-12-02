<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cajas de Distribución
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Botones superiores -->
        <div class="flex justify-between mb-6">
            <a href="{{ route('dashboard') }}"
               class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                ← Volver al Dashboard
            </a>

            <a href="{{ route('cajas_distribucion.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                + Nueva Caja
            </a>
        </div>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de Cajas -->
        <div class="bg-white shadow sm:rounded-lg overflow-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-500 font-medium uppercase">Nodo</th>
                        <th class="px-4 py-2 text-left text-gray-500 font-medium uppercase">Nombre</th>
                        <th class="px-4 py-2 text-left text-gray-500 font-medium uppercase">Zona</th>
                        <th class="px-4 py-2 text-left text-gray-500 font-medium uppercase">Usuarios</th>
                        <th class="px-4 py-2 text-left text-gray-500 font-medium uppercase">Acción</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($cajas as $caja)
                        <tr>
                            <td class="px-4 py-2">{{ $caja->nodo->nombre ?? 'Sin nodo' }}</td>
                            <td class="px-4 py-2">{{ $caja->nombre }}</td>
                            <td class="px-4 py-2">{{ $caja->zona }}</td>
                            <td class="px-4 py-2">{{ $caja->usuarios_conectados }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('cajas_distribucion.show', $caja->id) }}"
                                   class="inline-block px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition text-sm">
                                    🔍 Ver
                                </a>

                                <a href="{{ route('cajas_distribucion.mapa', $caja->id) }}"
                                   class="inline-block px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm ml-2">
                                    🗺 Mapa
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $cajas->links() }}
        </div>
    </div>
</x-app-layout>
