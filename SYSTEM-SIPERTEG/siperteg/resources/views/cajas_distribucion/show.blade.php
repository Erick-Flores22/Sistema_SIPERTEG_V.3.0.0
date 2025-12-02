{{-- resources/views/cajas_distribucion/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles de Caja: {{ $cajaDistribucion->nombre }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Botones -->
        <div class="flex justify-between mb-6">
            <a href="{{ route('cajas_distribucion.index') }}"
               class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                ← Volver al listado
            </a>

            <div class="space-x-2">
                <a href="{{ route('cajas_distribucion.edit', $cajaDistribucion->id) }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    ✏️ Editar Caja
                </a>

                @if($cajaDistribucion->nodo)
                    <a href="{{ route('nodos.show', $cajaDistribucion->nodo->id) }}"
                       class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                        🔍 Ver Nodo
                    </a>
                @endif
            </div>
        </div>

        <!-- Contenido -->
        <div class="bg-white shadow rounded-lg p-6 space-y-4">
            <div>
                <strong class="text-gray-700">Nodo:</strong>
                <p>{{ $cajaDistribucion->nodo->nombre ?? 'Sin nodo asociado' }}</p>
            </div>

            <div>
                <strong class="text-gray-700">Zona:</strong>
                <p>{{ $cajaDistribucion->zona }}</p>
            </div>

            <div>
                <strong class="text-gray-700">Capacidad:</strong>
                <p>{{ $cajaDistribucion->capacidad }}</p>
            </div>

            <div>
                <strong class="text-gray-700">Usuarios Conectados:</strong>
                <p>{{ $cajaDistribucion->usuarios_conectados }}</p>
            </div>

            <div>
                <strong class="text-gray-700">Potencias:</strong>
                <ul class="list-disc ml-5 text-sm text-gray-700">
                    <li><strong>Partida:</strong> {{ $cajaDistribucion->potencia_partida }} dBm</li>
                    <li><strong>Llegada:</strong> {{ $cajaDistribucion->potencia_llegada }} dBm</li>
                    <li><strong>Distribución:</strong> {{ $cajaDistribucion->potencia_distribucion }} dBm</li>
                </ul>
            </div>

            <div>
                <strong class="text-gray-700">Observaciones:</strong>
                <p>{{ $cajaDistribucion->observaciones }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <strong class="text-gray-700">Plano Subtroncal:</strong><br>
                    @if($cajaDistribucion->plano_subtroncal)
                        <img src="{{ asset('storage/' . $cajaDistribucion->plano_subtroncal) }}"
                             alt="Plano Subtroncal"
                             class="mt-2 rounded shadow w-full max-h-64 object-contain">
                    @else
                        <p class="text-gray-500">No disponible</p>
                    @endif
                </div>

                <div>
                    <strong class="text-gray-700">Foto Caja:</strong><br>
                    @if($cajaDistribucion->foto_caja)
                        <img src="{{ asset('storage/' . $cajaDistribucion->foto_caja) }}"
                             alt="Foto Caja"
                             class="mt-2 rounded shadow w-full max-h-64 object-contain">
                    @else
                        <p class="text-gray-500">No disponible</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
