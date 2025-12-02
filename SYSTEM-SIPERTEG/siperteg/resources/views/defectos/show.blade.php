<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Reporte') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg sm:rounded-2xl p-6">

                <div class="space-y-4">
                    <div>
                        <span class="font-semibold text-gray-700">ID:</span>
                        <p>{{ $defecto->id }}</p>
                    </div>

                    <div>
                        <span class="font-semibold text-gray-700">Nombre:</span>
                        <p>{{ $defecto->nombre }}</p>
                    </div>

                    <div>
                        <span class="font-semibold text-gray-700">Celular:</span>
                        <p>{{ $defecto->celular }}</p>
                    </div>

                    <div>
                        <span class="font-semibold text-gray-700">Dirección:</span>
                        <p>{{ $defecto->direccion }}</p>
                    </div>

                    <div>
                        <span class="font-semibold text-gray-700">Detalle:</span>
                        <p class="whitespace-pre-line">{{ $defecto->detalle }}</p>
                    </div>

                    <div>
                        <span class="font-semibold text-gray-700">Estado:</span>
                        <span class="
                            inline-block px-3 py-1 rounded-full text-sm font-medium
                            @if($defecto->estado == 'PENDIENTE') bg-yellow-100 text-yellow-800
                            @elseif($defecto->estado == 'EN REVISION') bg-blue-100 text-blue-800
                            @elseif($defecto->estado == 'ASIGNADA') bg-indigo-100 text-indigo-800
                            @elseif($defecto->estado == 'SOLUCIONADA') bg-green-100 text-green-800
                            @endif">
                            {{ $defecto->estado }}
                        </span>
                    </div>

                    <div>
                        <span class="font-semibold text-gray-700">Observaciones:</span>
                        <p>{{ $defecto->observaciones ?? 'Sin observaciones' }}</p>
                    </div>

                    <div class="text-sm text-gray-500 border-t pt-4">
                        <p>Creado: {{ $defecto->created_at->format('d/m/Y H:i') }}</p>
                        <p>Actualizado: {{ $defecto->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-6 border-t pt-4">
                    <a href="{{ route('defectos.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                        ← Volver
                    </a>

                    <div class="flex space-x-2">
                        <a href="{{ route('defectos.edit', $defecto->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 px-4 rounded-lg">
                            Editar
                        </a>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
