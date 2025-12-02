<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        💰 Cobros del mes {{ $periodo->mes_nombre }} {{ $periodo->gestion->anio }}
      </h2>

      {{-- Botón para crear un nuevo cobro --}}
      <a href="{{ route('cobros.create', $periodo) }}"
   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition">
  ➕ Nuevo Cobro
</a>
    </div>
  </x-slot>

  <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
      
      {{-- Tabla de cobros --}}
      <div class="overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200 dark:divide-gray-700 text-sm">
          <thead class="bg-gray-100 dark:bg-gray-700">
            <tr>
              <th class="px-4 py-2 text-left">Abonado</th>
              <th class="px-4 py-2 text-right">Monto</th>
              <th class="px-4 py-2 text-center">Estado</th>
              <th class="px-4 py-2 text-center">Fecha pago</th>
              <th class="px-4 py-2 text-center">Plataforma</th>
              <th class="px-4 py-2 text-center">Acciones</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($cobros as $c)
              <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                {{-- Abonado --}}
                <td class="px-4 py-2 font-medium text-gray-900 dark:text-gray-100">
                  {{ $c->abonado->nombre }} {{ $c->abonado->apellido }}
                </td>

                {{-- Monto --}}
                <td class="px-4 py-2 text-right font-semibold text-gray-700 dark:text-gray-200">
                  {{ number_format($c->monto, 2) }} Bs
                </td>

                {{-- Estado --}}
                <td class="px-4 py-2 text-center">
                  @if($c->estado_pago === 'pagado')
                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                      ✅ Pagado
                    </span>
                  @else
                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                      ⏳ Pendiente
                    </span>
                  @endif
                </td>

                {{-- Fecha de pago --}}
                <td class="px-4 py-2 text-center">
                  {{ $c->fecha_pago ? \Carbon\Carbon::parse($c->fecha_pago)->format('Y-m-d') : '—' }}
                </td>

                {{-- Plataforma --}}
                <td class="px-4 py-2 text-center">
                  {{ $c->plataforma ?? '—' }}
                </td>

                {{-- Acciones --}}
                <td class="px-4 py-2 text-center space-x-2">
                  @if($c->estado_pago === 'pendiente')
                    <a href="{{ route('cobros.create', $periodo) }}?abonado_id={{ $c->abonado->id }}"
                       class="inline-flex items-center px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-xs">
                      💰 Registrar pago
                    </a>
                  @else
                    <span class="text-gray-500 text-xs">✔ Sin acciones</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                  No hay cobros registrados en este periodo.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>
