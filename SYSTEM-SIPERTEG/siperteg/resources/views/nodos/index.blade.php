<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Nodos
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">

            @if (session('success'))
                <div class="mb-4 text-green-600 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Botones: Volver al Dashboard y Crear Nuevo Nodo -->
            <div class="flex justify-between mb-6">
                <a href="{{ route('dashboard') }}"
                   class="px-5 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 transition font-semibold">
                    ← Volver al Dashboard
                </a>

                <a href="{{ route('nodos.create') }}"
                   class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition font-semibold">
                    + Nuevo Nodo
                </a>
            </div>

            <table class="w-full table-auto text-left border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Zona</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nodos as $nodo)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $nodo->id }}</td>
                            <td class="px-4 py-2">{{ $nodo->nombre }}</td>
                            <td class="px-4 py-2">{{ $nodo->zona }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('nodos.show', $nodo) }}"
                                   class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                    Ver
                                </a>
                                <a href="{{ route('nodos.mapa', $nodo) }}"
                                   class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
                                    Mapa
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $nodos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
