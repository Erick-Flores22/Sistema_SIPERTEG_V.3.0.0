<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Planes de Internet
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('planes.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Crear nuevo plan
            </a>

            @if(session('success'))
                <div class="mt-4 p-3 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mt-6 bg-white p-4 rounded shadow">
                <table class="w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">Nombre</th>
                            <th class="p-2 border">Velocidad</th>
                            <th class="p-2 border">Precio mensual</th>
                            <th class="p-2 border">Instalación</th>
                            <th class="p-2 border">Promo</th>
                            <th class="p-2 border">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($planes as $plan)
                            <tr class="text-sm">
                                <td class="border p-2">{{ $plan->nombre }}</td>
                                <td class="border p-2">{{ $plan->velocidad_megas }} Mbps</td>
                                <td class="border p-2">{{ number_format($plan->precio_mensual, 2) }} Bs</td>
                                <td class="border p-2">{{ number_format($plan->precio_instalacion, 2) }} Bs</td>
                                <td class="border p-2">
                                    @if($plan->es_promocion)
                                        {{ number_format($plan->precio_promocion_instalacion, 2) }} Bs
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="border p-2">
                                    <a href="{{ route('planes.edit', $plan) }}"
                                       class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $planes->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
