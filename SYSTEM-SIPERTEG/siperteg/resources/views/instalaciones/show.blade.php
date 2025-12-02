<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Instalación') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow-sm">
            <div class="space-y-2">
                <p><strong>Nombre:</strong> {{ $instalacion->nombre }}</p>
                <p><strong>Celular:</strong> {{ $instalacion->celular }}</p>
                <p><strong>Dirección:</strong> {{ $instalacion->direccion }}</p>
                
                <p><strong>Estado:</strong> {{ $instalacion->estado }}</p>
                <p><strong>Observaciones:</strong> {{ $instalacion->observaciones }}</p>
            </div>

            <div class="mt-4">
                <a href="{{ route('instalaciones.index') }}" class="text-gray-600 hover:underline">← Volver</a>
            </div>
        </div>
    </div>
</x-app-layout>
