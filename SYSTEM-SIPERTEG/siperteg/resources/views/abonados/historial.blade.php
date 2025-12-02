<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Historial de {{ $abonado->nombre }} {{ $abonado->apellido }}
      </h2>
      <div class="flex space-x-2">
        <a href="{{ route('abonados.index') }}"
           class="px-3 py-1 bg-gray-600 text-white rounded hover:bg-gray-700">
          Volver
        </a>
        <a href="{{ route('abonados.historial.pdf', $abonado) }}"
           class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
          Descargar PDF
        </a>
      </div>
    </div>
  </x-slot>

  <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8" x-data="{ tab: 'personal' }">
    {{-- Pestañas --}}
    <nav class="flex space-x-4 border-b mb-6">
      <button @click="tab='personal'"
              :class="tab==='personal' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600'"
              class="pb-2">Personales</button>
      <button @click="tab='tecnicos'"
              :class="tab==='tecnicos' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600'"
              class="pb-2">Técnicos</button>
      <button @click="tab='cobros'"
              :class="tab==='cobros' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600'"
              class="pb-2">Cobros</button>
      <button @click="tab='fallas'"
              :class="tab==='fallas' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600'"
              class="pb-2">Fallas</button>
    </nav>

    {{-- Personales --}}
    <div x-show="tab==='personal'">
      <div class="bg-white shadow rounded-lg p-6 space-y-2">
        <p><strong>Nombre:</strong> {{ $abonado->nombre }} {{ $abonado->apellido }}</p>
        <p><strong>CI:</strong> {{ $abonado->ci }}</p>
        <p><strong>Teléfono 1:</strong> {{ $abonado->telefono1 }}</p>
        <p><strong>Teléfono 2:</strong> {{ $abonado->telefono2 ?? '—' }}</p>
        <p><strong>Dirección:</strong> {{ $abonado->zona }}, {{ $abonado->calle }} #{{ $abonado->numero_casa }}</p>
        <p><strong>Fecha corte:</strong> {{ $abonado->fecha_corte?->format('Y-m-d') ?? '—' }}</p>
        <p><strong>Estado:</strong> {{ ucfirst($abonado->estado) }}</p>
      </div>
    </div>

    {{-- Técnicos --}}
    <div x-show="tab==='tecnicos'">
      @if($abonado->datosTecnico)
        @php($d = $abonado->datosTecnico)
        <div class="bg-white shadow rounded-lg p-6 space-y-2">
          <p><strong>Plan:</strong> {{ $d->plan }}</p>
          <p><strong>ODN:</strong> {{ $d->odn }}</p>
          <p><strong>PON:</strong> {{ $d->pon }}</p>
          <p><strong>Password:</strong> {{ $d->password }}</p>
          <p><strong>Cód. Técnico:</strong> {{ $d->codigo_tecnico }}</p>
          <p><strong>Cód. Sistema:</strong> {{ $d->codigo_sistema }}</p>
          <p><strong>Fecha Instalación:</strong> {{ $d->fecha_instalacion?->format('Y-m-d') ?? '—' }}</p>
          <p><strong>Nodo:</strong> {{ $d->nodo?->nombre ?? '—' }}</p>
          <p><strong>Caja Distribución:</strong> {{ $d->cajaDistribucion?->nombre ?? '—' }}</p>
          <p><strong>Potencia Partida:</strong> {{ $d->potencia_partida }}</p>
          <p><strong>Potencia Llegada:</strong> {{ $d->potencia_llegada }}</p>
          <p><strong>Observaciones:</strong> {{ $d->observaciones ?? '—' }}</p>

          @if($d->foto_plano)
            <div class="mt-4">
              <p class="font-semibold">Foto del Plano:</p>
              <img src="{{ Storage::url($d->foto_plano) }}"
                   alt="Foto Plano" class="mt-2 max-h-56 border rounded shadow">
            </div>
          @endif
        </div>
      @else
        <p class="text-gray-600">No hay datos técnicos registrados.</p>
      @endif
    </div>

    {{-- Cobros --}}
    <div x-show="tab==='cobros'">
      <div class="bg-white shadow rounded-lg p-4">
        @if($abonado->cobros->isEmpty())
          <p class="text-gray-600">Sin cobros registrados.</p>
        @else
          @foreach($abonado->cobros->groupBy(fn($c) => $c->periodo->gestion->anio) as $anio => $cobrosPorAnio)
            <h3 class="text-lg font-bold text-gray-700 mt-4 mb-2">Gestión {{ $anio }}</h3>

            @foreach($cobrosPorAnio->groupBy(fn($c) => $c->periodo->mes) as $mes => $cobrosPorMes)
              <h4 class="text-md font-semibold text-gray-600 mb-2">
                Periodo: {{ ucfirst(\Carbon\Carbon::create()->month($mes)->locale('es')->translatedFormat('F')) }}
              </h4>

              <table class="min-w-full divide-y divide-gray-200 mb-4">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Fecha Pago</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Monto</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Plataforma</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  @foreach($cobrosPorMes as $c)
                  <tr>
                    <td class="px-4 py-2 text-sm text-gray-900">{{ $c->fecha_pago?->format('d/m/Y') ?? '—' }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">{{ number_format($c->monto,2) }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">{{ $c->plataforma ?? '—' }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">
                      <span class="px-2 py-1 rounded text-white {{ $c->estado_pago === 'pagado' ? 'bg-green-500' : 'bg-yellow-500' }}">
                        {{ ucfirst($c->estado_pago) }}
                      </span>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            @endforeach
          @endforeach
        @endif
      </div>
    </div>

    {{-- Fallas --}}
    <div x-show="tab==='fallas'">
      <div class="bg-white shadow rounded-lg p-4">
        @if($abonado->fallas->isEmpty())
          <p class="text-gray-600">Sin fallas reportadas.</p>
        @else
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Detalle</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($abonado->fallas as $f)
              <tr>
                <td class="px-4 py-2 text-sm text-gray-900">{{ ucfirst($f->tipo_falla) }}</td>
                <td class="px-4 py-2 text-sm text-gray-900">{{ $f->detalle ?? '—' }}</td>
                <td class="px-4 py-2 text-sm text-gray-900">{{ ucfirst($f->estado) }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>
