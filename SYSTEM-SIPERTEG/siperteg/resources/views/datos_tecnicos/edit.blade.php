<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Editar Datos Técnicos') }}
    </h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

        {{-- Formulario de edición --}}
        <form action="{{ route('datos_tecnicos.update', $datosTecnico->id) }}" 
              method="POST" 
              enctype="multipart/form-data" {{-- 🔹 NECESARIO PARA ARCHIVOS --}}
              class="space-y-6">
          @csrf
          @method('PUT')

          {{-- Abonado asociado (readonly) --}}
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
              Abonado
            </label>
            <input type="text" 
                   value="{{ $datosTecnico->abonado->nombre }} {{ $datosTecnico->abonado->apellido }} (CI: {{ $datosTecnico->abonado->ci }})"
                   class="w-full border p-2 rounded bg-gray-100 cursor-not-allowed" readonly>
            <input type="hidden" name="abonado_id" value="{{ $datosTecnico->abonado_id }}">
          </div>

          {{-- Grid de datos técnicos --}}
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<div class="mb-4">
    <label class="block font-medium">Plan de Internet</label>
    <select name="plan_id" class="w-full border rounded p-2">
        @foreach($planes as $plan)
            <option value="{{ $plan->id }}" 
                @selected($datosTecnico->plan_id == $plan->id)>
                {{ $plan->nombre }} ({{ $plan->velocidad_megas }} Mbps)
            </option>
        @endforeach
    </select>
</div>


            <div>
              <label for="odn">ODN</label>
              <input type="text" name="odn" id="odn" value="{{ old('odn', $datosTecnico->odn) }}"
                class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
              @error('odn') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
              <label for="password">Password</label>
              <input type="text" name="password" id="password" value="{{ old('password', $datosTecnico->password) }}"
                class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
              @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
              <label for="codigo_tecnico">Código Técnico</label>
              <input type="text" name="codigo_tecnico" id="codigo_tecnico" value="{{ old('codigo_tecnico', $datosTecnico->codigo_tecnico) }}"
                class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
              @error('codigo_tecnico') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
              <label for="codigo_sistema">Código Sistema</label>
              <input type="text" name="codigo_sistema" id="codigo_sistema" value="{{ old('codigo_sistema', $datosTecnico->codigo_sistema) }}"
                class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
              @error('codigo_sistema') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
              <label for="fecha_instalacion">Fecha Instalación</label>
              <input type="date" name="fecha_instalacion" id="fecha_instalacion" 
                value="{{ old('fecha_instalacion', optional($datosTecnico->fecha_instalacion)->format('Y-m-d')) }}"
                class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
              @error('fecha_instalacion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
              <label for="nodo_id">Nodo</label>
              <select name="nodo_id" id="nodo_id" class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">-- Selecciona un nodo --</option>
                @foreach($nodos as $nodo)
                  <option value="{{ $nodo->id }}" {{ old('nodo_id', $datosTecnico->nodo_id) == $nodo->id ? 'selected' : '' }}>
                    {{ $nodo->nombre }}
                  </option>
                @endforeach
              </select>
              @error('nodo_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
              <label for="caja_distribucion_id">Caja Distribución</label>
              <select name="caja_distribucion_id" id="caja_distribucion_id" class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">-- Selecciona una caja --</option>
                @foreach($cajas as $caja)
                  <option value="{{ $caja->id }}" {{ old('caja_distribucion_id', $datosTecnico->caja_distribucion_id) == $caja->id ? 'selected' : '' }}>
                    {{ $caja->nombre }}
                  </option>
                @endforeach
              </select>
              @error('caja_distribucion_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
              <label for="potencia_partida">Potencia Partida</label>
              <input type="number" step="0.01" name="potencia_partida" id="potencia_partida" 
                value="{{ old('potencia_partida', $datosTecnico->potencia_partida) }}"
                class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
              @error('potencia_partida') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
              <label for="potencia_llegada">Potencia Llegada</label>
              <input type="number" step="0.01" name="potencia_llegada" id="potencia_llegada" 
                value="{{ old('potencia_llegada', $datosTecnico->potencia_llegada) }}"
                class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
              @error('potencia_llegada') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

          </div>

          {{-- Foto del plano --}}
          <div>
            <label for="foto_plano">Foto del plano de instalación</label>

            @if($datosTecnico->foto_plano)
              <div class="mb-3">
                <p class="text-sm text-gray-600">Foto actual:</p>
                <img src="{{ Storage::url($datosTecnico->foto_plano) }}" 
                     alt="Foto del plano" class="h-32 border rounded shadow">
              </div>
            @endif

            <input type="file" name="foto_plano" id="foto_plano" 
                   class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500"
                   accept="image/*">
            @error('foto_plano') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>

          {{-- Observaciones --}}
          <div>
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" id="observaciones" rows="3"
              class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500">{{ old('observaciones', $datosTecnico->observaciones) }}</textarea>
            @error('observaciones') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>

          {{-- Botones --}}
          <div class="flex justify-end space-x-2">
            <a href="{{ route('abonados.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
              Cancelar
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
              Actualizar
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</x-app-layout>
