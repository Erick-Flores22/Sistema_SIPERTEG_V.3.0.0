<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Editar Nodo
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow space-y-6">

            <form action="{{ route('nodos.update', $nodo) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" id="nombre"
                               value="{{ old('nombre', $nodo->nombre) }}"
                               class="mt-1 w-full border-gray-300 rounded shadow-sm" required>
                        @error('nombre')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                    </div>

                    <!-- Zona -->
                    <div>
                        <label for="zona" class="block text-sm font-medium text-gray-700">Zona</label>
                        <input type="text" name="zona" id="zona"
                               value="{{ old('zona', $nodo->zona) }}"
                               class="mt-1 w-full border-gray-300 rounded shadow-sm" required>
                        @error('zona')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                    </div>

                    <!-- Capacidad -->
                    <div>
                        <label for="capacidad" class="block text-sm font-medium text-gray-700">Capacidad</label>
                        <input type="number" name="capacidad" id="capacidad"
                               value="{{ old('capacidad', $nodo->capacidad) }}"
                               class="mt-1 w-full border-gray-300 rounded shadow-sm" required>
                        @error('capacidad')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                    </div>

                    <!-- Puertos -->
                    <div>
                        <label for="puerto_olt" class="block text-sm font-medium text-gray-700">Puerto OLT</label>
                        <input type="text" name="puerto_olt" id="puerto_olt"
                               value="{{ old('puerto_olt', $nodo->puerto_olt) }}"
                               class="mt-1 w-full border-gray-300 rounded shadow-sm" required>
                        @error('puerto_olt')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="puerto_edfa" class="block text-sm font-medium text-gray-700">Puerto EDFA</label>
                        <input type="text" name="puerto_edfa" id="puerto_edfa"
                               value="{{ old('puerto_edfa', $nodo->puerto_edfa) }}"
                               class="mt-1 w-full border-gray-300 rounded shadow-sm" required>
                        @error('puerto_edfa')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                    </div>

                    <!-- Potencias -->
                    <div>
                        <label for="potencia_partida" class="block text-sm font-medium text-gray-700">Potencia Partida (dBm)</label>
                        <input type="number" step="0.01" name="potencia_partida" id="potencia_partida"
                               value="{{ old('potencia_partida', $nodo->potencia_partida) }}"
                               class="mt-1 w-full border-gray-300 rounded shadow-sm" required>
                        @error('potencia_partida')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="potencia_llegada" class="block text-sm font-medium text-gray-700">Potencia Llegada (dBm)</label>
                        <input type="number" step="0.01" name="potencia_llegada" id="potencia_llegada"
                               value="{{ old('potencia_llegada', $nodo->potencia_llegada) }}"
                               class="mt-1 w-full border-gray-300 rounded shadow-sm" required>
                        @error('potencia_llegada')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="potencia_distribucion" class="block text-sm font-medium text-gray-700">Potencia Distribución (dBm)</label>
                        <input type="number" step="0.01" name="potencia_distribucion" id="potencia_distribucion"
                               value="{{ old('potencia_distribucion', $nodo->potencia_distribucion) }}"
                               class="mt-1 w-full border-gray-300 rounded shadow-sm" required>
                        @error('potencia_distribucion')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                    </div>

                    <!-- Cajas conectadas -->
                    <div>
                        <label for="cajas_conectadas" class="block text-sm font-medium text-gray-700">Cajas Conectadas</label>
                        <input type="number" name="cajas_conectadas" id="cajas_conectadas"
                               value="{{ old('cajas_conectadas', $nodo->cajas_conectadas) }}"
                               class="mt-1 w-full border-gray-300 rounded shadow-sm" required>
                        @error('cajas_conectadas')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                    </div>

                    <!-- Observaciones -->
                    <div class="md:col-span-2">
                        <label for="observacion" class="block text-sm font-medium text-gray-700">Observaciones</label>
                        <textarea name="observacion" id="observacion" rows="3"
                                  class="mt-1 w-full border-gray-300 rounded shadow-sm">{{ old('observacion', $nodo->observacion) }}</textarea>
                        @error('observacion')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                    </div>

                    <!-- Plano Troncal -->
                    <div>
                        <label for="plano_troncal" class="block text-sm font-medium text-gray-700">Plano Troncal (imagen)</label>
                        <input type="file" name="plano_troncal" id="plano_troncal"
                               class="mt-1 w-full border-gray-300 rounded shadow-sm">
                        @if ($nodo->plano_troncal)
                            <img src="{{ asset('storage/' . $nodo->plano_troncal) }}"
                                 alt="Plano actual" class="w-40 mt-2 rounded shadow">
                        @endif
                    </div>

                    <!-- Foto Nodo -->
                    <div>
                        <label for="foto_nodo" class="block text-sm font-medium text-gray-700">Foto del Nodo (imagen)</label>
                        <input type="file" name="foto_nodo" id="foto_nodo"
                               class="mt-1 w-full border-gray-300 rounded shadow-sm">
                        @if ($nodo->foto_nodo)
                            <img src="{{ asset('storage/' . $nodo->foto_nodo) }}"
                                 alt="Foto actual" class="w-40 mt-2 rounded shadow">
                        @endif
                    </div>

                </div>

                <!-- Botones -->
                <div class="mt-6 flex justify-between">
                    <a href="{{ route('nodos.index') }}"
                       class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        ← Cancelar
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                        💾 Guardar Cambios
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
