<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🔌 Mapa de Conexión - {{ $nodo->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Contenedor del Mapa -->
            <div class="relative w-full h-[550px] bg-gradient-to-br from-gray-50 via-white to-gray-100 border rounded-xl shadow-lg overflow-hidden">

                <!-- Nodo central -->
                <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2
                            bg-blue-700 text-white px-6 py-3 rounded-full shadow-lg text-lg font-semibold z-20">
                    {{ $nodo->nombre }}
                </div>

                <!-- Cajas conectadas y líneas -->
                @foreach($cajas as $index => $caja)
                    @php
                        $angle = ($index / max(1, count($cajas))) * 2 * pi();
                        $radius = 180;
                        $x = cos($angle) * $radius;
                        $y = sin($angle) * $radius;
                        $color = ['red','green','blue','orange','purple'][$index % 5];
                    @endphp

                    <!-- Línea SVG -->
                    <svg class="absolute inset-0 w-full h-full pointer-events-none z-10">
                        <line x1="50%" y1="50%"
                              x2="{{ 50 + $x / 5 }}%" y2="{{ 50 + $y / 5 }}%"
                              stroke="{{ $color }}"
                              stroke-width="2"
                              stroke-dasharray="5,5"/>
                    </svg>

                    <!-- Caja conectada -->
                    <!-- Caja conectada con link al mapa de la caja -->
<div class="absolute transition duration-300 hover:scale-105 z-20"
     style="left: calc(50% + {{ $x }}px); top: calc(50% + {{ $y }}px);">
    <a href="{{ route('cajas_distribucion.mapa', $caja->id) }}"
       class="block bg-white border-2 border-{{ $color }}-400 text-gray-800 px-4 py-2 rounded-lg shadow-md text-sm font-medium hover:bg-{{ $color }}-100 transition">
        {{ $caja->nombre }}
    </a>
</div>

                @endforeach
            </div>

           <!-- Botones debajo del mapa -->
<div class="mt-8 flex justify-center space-x-4">
    <a href="{{ route('nodos.show', $nodo) }}"
       class="inline-block px-6 py-2 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700 transition">
        👁 Ver detalles del nodo
    </a>

    <a href="{{ route('nodos.index') }}"
       class="inline-block px-6 py-2 bg-gray-700 text-white text-sm rounded-lg shadow hover:bg-gray-800 transition">
        ← Volver al listado
    </a>
</div>
        </div>
    </div>
</x-app-layout>
