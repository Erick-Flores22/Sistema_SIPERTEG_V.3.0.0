{{-- resources/views/nodos/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nuevo Nodo
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form action="{{ route('nodos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('nombre')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="zona" class="block text-sm font-medium text-gray-700">Zona</label>
                            <input type="text" name="zona" id="zona" value="{{ old('zona') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('zona')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="capacidad" class="block text-sm font-medium text-gray-700">Capacidad</label>
                            <input type="number" name="capacidad" id="capacidad" value="{{ old('capacidad') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('capacidad')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="cajas_conectadas" class="block text-sm font-medium text-gray-700">Cajas Conectadas</label>
                            <input type="number" name="cajas_conectadas" id="cajas_conectadas" value="{{ old('cajas_conectadas') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('cajas_conectadas')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="puerto_olt" class="block text-sm font-medium text-gray-700">Puerto OLT</label>
                            <input type="text" name="puerto_olt" id="puerto_olt" value="{{ old('puerto_olt') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('puerto_olt')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="puerto_edfa" class="block text-sm font-medium text-gray-700">Puerto EDFA</label>
                            <input type="text" name="puerto_edfa" id="puerto_edfa" value="{{ old('puerto_edfa') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('puerto_edfa')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="potencia_partida" class="block text-sm font-medium text-gray-700">Potencia Partida (dBm)</label>
                            <input type="text" name="potencia_partida" id="potencia_partida" value="{{ old('potencia_partida') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('potencia_partida')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="potencia_llegada" class="block text-sm font-medium text-gray-700">Potencia Llegada (dBm)</label>
                            <input type="text" name="potencia_llegada" id="potencia_llegada" value="{{ old('potencia_llegada') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('potencia_llegada')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="potencia_distribucion" class="block text-sm font-medium text-gray-700">Potencia Distribución (dBm)</label>
                            <input type="text" name="potencia_distribucion" id="potencia_distribucion" value="{{ old('potencia_distribucion') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('potencia_distribucion')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="foto_nodo" class="block text-sm font-medium text-gray-700">Foto del Nodo</label>
                            <input type="file" name="foto_nodo" id="foto_nodo"
                                   class="mt-1 block w-full text-sm text-gray-700 border-gray-300 rounded-md shadow-sm">
                            @error('foto_nodo')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="plano_troncal" class="block text-sm font-medium text-gray-700">Plano Troncal</label>
                            <input type="file" name="plano_troncal" id="plano_troncal"
                                   class="mt-1 block w-full text-sm text-gray-700 border-gray-300 rounded-md shadow-sm">
                            @error('plano_troncal')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
{{-- Observaciones --}}
                    <div class="mb-6">
                        <label for="observacion" class="block text-sm font-medium text-gray-700">Observaciones</label>
                        <textarea name="observacion" id="observacion" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('observacion') }}</textarea>
                        @error('observacion')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="mt-6 flex items-center space-x-4">
                        <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Guardar
                        </button>
                        <a href="{{ route('nodos.index') }}"
                           class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
