<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📍 Detalles del Nodo
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-6 shadow rounded-lg space-y-6">

            <!-- Datos del nodo -->
            <div class="space-y-2">
                <p><strong>Nombre:</strong> {{ $nodo->nombre }}</p>
                <p><strong>Zona:</strong> {{ $nodo->zona }}</p>
                <p><strong>Capacidad:</strong> {{ $nodo->capacidad }}</p>
                <p><strong>Puertos:</strong> OLT: {{ $nodo->puerto_olt }} | EDFA: {{ $nodo->puerto_edfa }}</p>
                <p><strong>Potencia:</strong> Partida: {{ $nodo->potencia_partida }} dBm |
                    Llegada: {{ $nodo->potencia_llegada }} dBm |
                    Distribución: {{ $nodo->potencia_distribucion }} dBm</p>
                <p><strong>Cajas Conectadas:</strong> {{ $nodo->cajas_conectadas }}</p>
                <p><strong>Observaciones:</strong> {{ $nodo->observacion ?? 'Sin observaciones' }}</p>
            </div>

            <!-- Plano Troncal -->
            <div>
                <strong>Plano Troncal:</strong><br>
                @if ($nodo->plano_troncal)
                    <img src="{{ asset('storage/' . $nodo->plano_troncal) }}" alt="Plano Troncal"
                         class="w-full max-w-md rounded shadow mt-2">
                @else
                    <p class="text-gray-500">No disponible</p>
                @endif
            </div>

            <!-- Foto Nodo -->
            <div>
                <strong>Foto del Nodo:</strong><br>
                @if ($nodo->foto_nodo)
                    <img src="{{ asset('storage/' . $nodo->foto_nodo) }}" alt="Foto Nodo"
                         class="w-full max-w-md rounded shadow mt-2">
                @else
                    <p class="text-gray-500">No disponible</p>
                @endif
            </div>

            <!-- Botones -->
            <div class="flex justify-between pt-6">
                <a href="{{ route('nodos.index') }}"
                   class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                    ← Volver
                </a>

                <a href="{{ route('nodos.edit', $nodo) }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    ✏️ Editar Nodo
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
