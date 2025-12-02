<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Instalaciones') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <a href="{{ route('instalaciones.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Nueva Instalación</a>

            @if(session('success'))
                <div class="mt-3 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full mt-4 border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 border">ID</th>
                        <th class="px-3 py-2 border">Nombre</th>
                        <th class="px-3 py-2 border">Celular</th>
                        <th class="px-3 py-2 border">Dirección</th>
                       
                        <th class="px-3 py-2 border">Estado</th>
                        <th class="px-3 py-2 border text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($instalaciones as $instalacion)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 border">{{ $instalacion->id }}</td>
                        <td class="px-3 py-2 border">{{ $instalacion->nombre }}</td>
                        <td class="px-3 py-2 border">{{ $instalacion->celular }}</td>
                        <td class="px-3 py-2 border">{{ $instalacion->direccion }}</td>
                        
                        <td class="px-3 py-2 border">{{ $instalacion->estado }}</td>
                        <td class="px-3 py-2 border text-center">
                            <a href="{{ route('instalaciones.show', $instalacion) }}" class="text-blue-600 hover:underline">Ver</a> |
                            <a href="{{ route('instalaciones.edit', $instalacion) }}" class="text-yellow-600 hover:underline">Editar</a> |
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $instalaciones->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
