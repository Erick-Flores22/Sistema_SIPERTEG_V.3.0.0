<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Crear Datos Técnicos') }}
    </h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

        {{-- IMPORTANTE: enctype para permitir subida de archivos --}}
        <form action="{{ route('datos_tecnicos.store') }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-6">
          @csrf

          {{-- Abonado asociado --}}
          <div>
            <label for="abonado_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
              Abonado
            </label>
            <select name="abonado_id" id="abonado_id" class="w-full border rounded p-2 focus:ring-blue-500 focus:border-blue-500" required>
              <option value="">-- Selecciona un abonado --</option>
              @foreach($abonados as $abonado)
                <option value="{{ $abonado->id }}" 
                  {{ request('abonado_id') == $abonado->id ? 'selected' : '' }}>
                  {{ $abonado->nombre }} {{ $abonado->apellido }} (CI: {{ $abonado->ci }})
                </option>
              @endforeach
            </select>
            @error('abonado_id')
              <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
          </div>

          {{-- Grid de datos técnicos --}}
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="mb-4">
    <label class="block font-medium">Plan de Internet</label>
    <select name="plan_id" class="w-full border rounded p-2" required>
        <option value="">-- Seleccione un plan --</option>
        @foreach($planes as $plan)
            <option value="{{ $plan->id }}">
                {{ $plan->nombre }} ({{ $plan->velocidad_megas }} Mbps)
            </option>
        @endforeach
    </select>
</div>

            <div>
              <label for="odn">ODN</label>
              <input type="text" name="odn" id="odn" value="{{ old('odn') }}"
                class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
              @error('odn') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>


            <div>
              <label for="password">Password</label>
              <input type="text" name="password" id="password" value="{{ old('password') }}"
                class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
              @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
              <label for="codigo_tecnico">Código Técnico</label>
              <input type="text" name="codigo_tecnico" id="codigo_tecnico" value="{{ old('codigo_tecnico') }}"
                class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
              @error('codigo_tecnico') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
              <label for="codigo_sistema">Código Sistema</label>
              <input type="text" name="codigo_sistema" id="codigo_sistema" value="{{ old('codigo_sistema') }}"
                class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
              @error('codigo_sistema') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
              <label for="fecha_instalacion">Fecha Instalación</label>
              <input type="date" name="fecha_instalacion" id="fecha_instalacion" value="{{ old('fecha_instalacion') }}"
                class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
              @error('fecha_instalacion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
  <label for="nodo_id">Nodo</label>
  <select name="nodo_id" id="nodo_id" 
          class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
    <option value="">-- Selecciona un nodo --</option>
    @foreach($nodos as $nodo)
      <option value="{{ $nodo->id }}">{{ $nodo->nombre }}</option>
    @endforeach
  </select>
  @error('nodo_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
</div>

<div>
  <label for="caja_distribucion_id">Caja Distribución</label>
  <select name="caja_distribucion_id" id="caja_distribucion_id" 
          class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
    <option value="">-- Selecciona una caja --</option>
    {{-- las opciones se llenarán con JS --}}
  </select>
  @error('caja_distribucion_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
</div>


            <div>
              <label for="potencia_partida">Potencia Partida</label>
              <input type="number" step="0.01" name="potencia_partida" id="potencia_partida" value="{{ old('potencia_partida') }}"
                class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
              @error('potencia_partida') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
              <label for="potencia_llegada">Potencia Llegada</label>
              <input type="number" step="0.01" name="potencia_llegada" id="potencia_llegada" value="{{ old('potencia_llegada') }}"
                class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
              @error('potencia_llegada') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

          </div>

          {{-- Foto del plano --}}
          <div>
            <label for="foto_plano">Foto del plano de instalación</label>
            <input type="file" name="foto_plano" id="foto_plano" 
                   class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500"
                   accept="image/*">
            @error('foto_plano') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>

          {{-- Observaciones --}}
          <div>
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" id="observaciones" rows="3"
              class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500">{{ old('observaciones') }}</textarea>
            @error('observaciones') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>

          {{-- Botones --}}
          <div class="flex justify-end space-x-2">
            <a href="{{ route('abonados.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
              Cancelar
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
              Guardar
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
  @push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const nodoSelect = document.getElementById('nodo_id');
    const cajaSelect = document.getElementById('caja_distribucion_id');

    nodoSelect.addEventListener('change', function () {
      const nodoId = this.value;
      cajaSelect.innerHTML = '<option value="">Cargando...</option>';

      if (nodoId) {
        fetch(`/cajas-por-nodo/${nodoId}`)
          .then(response => response.json())
          .then(data => {
            cajaSelect.innerHTML = '<option value="">-- Selecciona una caja --</option>';
            data.forEach(caja => {
              let option = document.createElement('option');
              option.value = caja.id;
              option.textContent = caja.nombre;
              cajaSelect.appendChild(option);
            });
          })
          .catch(error => {
            console.error('Error al cargar cajas:', error);
            cajaSelect.innerHTML = '<option value="">Error al cargar</option>';
          });
      } else {
        cajaSelect.innerHTML = '<option value="">-- Selecciona un nodo primero --</option>';
      }
    });
  });
</script>
@endpush

</x-app-layout>
