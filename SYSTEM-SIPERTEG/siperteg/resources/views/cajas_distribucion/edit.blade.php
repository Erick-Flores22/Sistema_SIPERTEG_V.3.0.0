{{-- resources/views/cajas_distribucion/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Caja de Distribución
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form action="{{ route('cajas_distribucion.update', $cajaDistribucion) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Selección de Nodo --}}
                        <div>
                            <label for="nodo_id" class="block text-sm font-medium text-gray-700">Nodo</label>
                            <select name="nodo_id" id="nodo_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Seleccione un nodo --</option>
                                @foreach($nodos as $nodo)
                                    <option value="{{ $nodo->id }}" {{ $cajaDistribucion->nodo_id == $nodo->id ? 'selected' : '' }}>
                                        {{ $nodo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nodo_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Nombre --}}
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $cajaDistribucion->nombre) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('nombre')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Zona --}}
                        <div>
                            <label for="zona" class="block text-sm font-medium text-gray-700">Zona</label>
                            <input type="text" name="zona" id="zona" value="{{ old('zona', $cajaDistribucion->zona) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('zona')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Capacidad --}}
                        <div>
                            <label for="capacidad" class="block text-sm font-medium text-gray-700">Capacidad</label>
                            <input type="number" name="capacidad" id="capacidad" value="{{ old('capacidad', $cajaDistribucion->capacidad) }}" min="1" max="255" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('capacidad')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Potencia Partida --}}
                        <div>
                            <label for="potencia_partida" class="block text-sm font-medium text-gray-700">Potencia Partida</label>
                            <input type="number" step="0.01" name="potencia_partida" id="potencia_partida" value="{{ old('potencia_partida', $cajaDistribucion->potencia_partida) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('potencia_partida')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Potencia Llegada --}}
                        <div>
                            <label for="potencia_llegada" class="block text-sm font-medium text-gray-700">Potencia Llegada</label>
                            <input type="number" step="0.01" name="potencia_llegada" id="potencia_llegada" value="{{ old('potencia_llegada', $cajaDistribucion->potencia_llegada) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('potencia_llegada')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Potencia Distribución --}}
                        <div>
                            <label for="potencia_distribucion" class="block text-sm font-medium text-gray-700">Potencia Distribución</label>
                            <input type="number" step="0.01" name="potencia_distribucion" id="potencia_distribucion" value="{{ old('potencia_distribucion', $cajaDistribucion->potencia_distribucion) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('potencia_distribucion')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Usuarios Conectados --}}
                        <div>
                            <label for="usuarios_conectados" class="block text-sm font-medium text-gray-700">Usuarios Conectados</label>
                            <input type="number" name="usuarios_conectados" id="usuarios_conectados" value="{{ old('usuarios_conectados', $cajaDistribucion->usuarios_conectados) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('usuarios_conectados')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Plano Subtroncal --}}
                        <div>
                            <label for="plano_subtroncal" class="block text-sm font-medium text-gray-700">Plano Subtroncal (Imagen)</label>
                            <input type="file" name="plano_subtroncal" id="plano_subtroncal" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                           @if ($cajaDistribucion->plano_subtroncal)
    <div class="mt-2">
        <p class="text-sm text-gray-600 mb-1">Imagen actual:</p>
        <img src="{{ asset('storage/' . $cajaDistribucion->plano_subtroncal) }}" alt="Plano Subtroncal" class="h-32 rounded shadow border border-gray-300">
    </div>
@endif

                        </div>

                        {{-- Foto Caja --}}
                        <div>
                            <label for="foto_caja" class="block text-sm font-medium text-gray-700">Foto de la Caja</label>
                            <input type="file" name="foto_caja" id="foto_caja" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
@if ($cajaDistribucion->foto_caja)
    <div class="mt-2">
        <p class="text-sm text-gray-600 mb-1">Imagen actual:</p>
        <img src="{{ asset('storage/' . $cajaDistribucion->foto_caja) }}" alt="Foto Caja" class="h-32 rounded shadow border border-gray-300">
    </div>
@endif

                        </div>
                    </div>

                    {{-- Observaciones (ocupa todo el ancho) --}}
                    <div class="mt-6">
                        <label for="observaciones" class="block text-sm font-medium text-gray-700">Observaciones</label>
                        <textarea name="observaciones" id="observaciones" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('observaciones', $cajaDistribucion->observaciones) }}</textarea>
                        @error('observaciones')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Botones --}}
                    <div class="mt-6 flex items-center space-x-4">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Actualizar
                        </button>
                        <a href="{{ route('cajas_distribucion.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
