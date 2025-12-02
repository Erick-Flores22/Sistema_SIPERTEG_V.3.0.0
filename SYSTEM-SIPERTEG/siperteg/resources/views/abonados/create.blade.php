<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nuevo Abonado
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form action="{{ route('abonados.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nombre --}}
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                   required>
                            @error('nombre')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Apellido --}}
                        <div>
                            <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                            <input type="text" name="apellido" id="apellido" value="{{ old('apellido') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                   required>
                            @error('apellido')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- CI --}}
                        <div>
                            <label for="ci" class="block text-sm font-medium text-gray-700">CI</label>
                            <input type="text" name="ci" id="ci" value="{{ old('ci') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                   required>
                            @error('ci')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Teléfono 1 --}}
                        <div>
                            <label for="telefono1" class="block text-sm font-medium text-gray-700">Teléfono 1</label>
                            <input type="text" name="telefono1" id="telefono1" value="{{ old('telefono1') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                   required>
                            @error('telefono1')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Teléfono 2 --}}
                        <div>
                            <label for="telefono2" class="block text-sm font-medium text-gray-700">Teléfono 2</label>
                            <input type="text" name="telefono2" id="telefono2" value="{{ old('telefono2') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('telefono2')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Zona --}}
                        <div>
                            <label for="zona" class="block text-sm font-medium text-gray-700">Zona</label>
                            <input type="text" name="zona" id="zona" value="{{ old('zona') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                   required>
                            @error('zona')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Calle --}}
                        <div>
                            <label for="calle" class="block text-sm font-medium text-gray-700">Calle</label>
                            <input type="text" name="calle" id="calle" value="{{ old('calle') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                   required>
                            @error('calle')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Número de Casa --}}
                        <div>
                            <label for="numero_casa" class="block text-sm font-medium text-gray-700">Número de Casa</label>
                            <input type="text" name="numero_casa" id="numero_casa" value="{{ old('numero_casa') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                   required>
                            @error('numero_casa')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Fecha de Corte --}}
                        <div>
                            <label for="fecha_corte" class="block text-sm font-medium text-gray-700">Fecha de Corte</label>
                            <input type="date" name="fecha_corte" id="fecha_corte" value="{{ old('fecha_corte') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('fecha_corte')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Estado --}}
                        <div>
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" id="estado"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="activo"   {{ old('estado')=='activo'   ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ old('estado')=='inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex items-center space-x-4">
                        <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Guardar
                        </button>
                        <a href="{{ route('abonados.index') }}"
                           class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
