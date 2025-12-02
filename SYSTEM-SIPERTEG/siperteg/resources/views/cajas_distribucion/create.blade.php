<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Nueva Caja de Distribución
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <form action="{{ route('cajas_distribucion.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nodo --}}
                        <div>
                            <label for="nodo_id" class="block text-sm font-medium text-gray-700">Nodo</label>
                            <select name="nodo_id" id="nodo_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Seleccione un nodo --</option>
                                @foreach($nodos as $nodo)
                                    <option value="{{ $nodo->id }}" {{ old('nodo_id') == $nodo->id ? 'selected' : '' }}>
                                        {{ $nodo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nodo_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Nombre --}}
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('nombre')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Zona --}}
                        <div>
                            <label for="zona" class="block text-sm font-medium text-gray-700">Zona</label>
                            <input type="text" name="zona" id="zona" value="{{ old('zona') }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('zona')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Capacidad --}}
                        <div>
                            <label for="capacidad" class="block text-sm font-medium text-gray-700">Capacidad</label>
                            <input type="number" name="capacidad" id="capacidad" value="{{ old('capacidad', 16) }}" min="1" max="255" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('capacidad')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Usuarios Conectados --}}
                        <div>
                            <label for="usuarios_conectados" class="block text-sm font-medium text-gray-700">Usuarios Conectados</label>
                            <input type="number" name="usuarios_conectados" id="usuarios_conectados"
                                   value="{{ old('usuarios_conectados', 0) }}" min="0" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('usuarios_conectados')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Potencias --}}
                        <div>
                            <label for="potencia_partida" class="block text-sm font-medium text-gray-700">Potencia Partida (dBm)</label>
                            <input type="number" step="0.01" name="potencia_partida" id="potencia_partida"
                                   value="{{ old('potencia_partida') }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('potencia_partida')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="potencia_llegada" class="block text-sm font-medium text-gray-700">Potencia Llegada (dBm)</label>
                            <input type="number" step="0.01" name="potencia_llegada" id="potencia_llegada"
                                   value="{{ old('potencia_llegada') }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('potencia_llegada')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="potencia_distribucion" class="block text-sm font-medium text-gray-700">Potencia Distribución (dBm)</label>
                            <input type="number" step="0.01" name="potencia_distribucion" id="potencia_distribucion"
                                   value="{{ old('potencia_distribucion') }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('potencia_distribucion')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Plano Subtroncal --}}
                        <div>
                            <label for="plano_subtroncal" class="block text-sm font-medium text-gray-700">Plano Subtroncal (imagen)</label>
                            <input type="file" name="plano_subtroncal" id="plano_subtroncal" accept="image/*"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('plano_subtroncal')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Foto Caja --}}
                        <div>
                            <label for="foto_caja" class="block text-sm font-medium text-gray-700">Foto de la Caja</label>
                            <input type="file" name="foto_caja" id="foto_caja" accept="image/*"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('foto_caja')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Observaciones --}}
                        <div class="md:col-span-2">
                            <label for="observaciones" class="block text-sm font-medium text-gray-700">Observaciones</label>
                            <textarea name="observaciones" id="observaciones" rows="3"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('observaciones') }}</textarea>
                            @error('observaciones')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="mt-6 flex justify-start gap-4">
                        <button type="submit"
                                class="px-6 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700">
                            Guardar
                        </button>
                        <a href="{{ route('cajas_distribucion.index') }}"
                           class="px-6 py-2 bg-gray-600 text-white font-semibold rounded hover:bg-gray-700">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
