<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      💰 Registrar pago - {{ $periodo->mes_nombre }} {{ $periodo->gestion->anio ?? 'Sin gestión' }}

    </h2>
  </x-slot>

  <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
      
      <form action="{{ route('cobros.store', $periodo) }}" method="POST" class="space-y-6">
        @csrf

        {{-- Abonado --}}
        <div>
          <label for="abonado_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Abonado
          </label>
          <select id="abonado_id" name="abonado_id" 
                  class="w-full border rounded p-2 select2"
                  required></select>
          @error('abonado_id')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        {{-- Monto --}}
        <div>
          <label for="monto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Monto
          </label>
          <input type="number" step="0.01" name="monto" id="monto"
                 class="w-full border rounded p-2"
                 value="{{ old('monto', 150) }}" required>
          @error('monto')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        {{-- Plataforma --}}
        <div>
          <label for="plataforma" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Plataforma
          </label>
          <select name="plataforma" id="plataforma" class="w-full border rounded p-2">
            <option value="">-- Selecciona --</option>
            <option value="Banco Fie">Banco Fie</option>
            <option value="Banco Bcp">Banco Bcp</option>
            <option value="Banco Sol">Banco Sol</option>
            <option value="Yape">Yape</option>
            <option value="Tigo Money">Tigo Money</option>


          </select>
          @error('plataforma')
            <span class="text-red-600 text-sm">{{ $message }}</span>
          @enderror
        </div>

        {{-- Botones --}}
        <div class="flex justify-end space-x-2">
          <a href="{{ route('cobros.index', $periodo) }}"
             class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Cancelar
          </a>
          <button type="submit"
                  class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Guardar
          </button>
        </div>
      </form>
    </div>
  </div>

  {{-- Scripts Select2 --}}
  @push('scripts')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
$(document).ready(function() {
    $('#abonado_id').select2({
        placeholder: '🔍 Busca un abonado...',
        ajax: {
            url: '{{ route("abonados.buscar") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return { q: params.term };
            },
            processResults: function (data) {
                return { results: data };
            },
            cache: true
        },
        minimumInputLength: 2
    });

    // 🚀 CUANDO SELECCIONAS EL ABONADO, OBTENER PRECIO DE SU PLAN
    $('#abonado_id').on('change', function() {
        var abonadoId = $(this).val();

        if (!abonadoId) return;

        $.ajax({
            url: "/abonado/" + abonadoId + "/plan",
            type: "GET",
            success: function(response) {
                $('#monto').val(response.precio);
            }
        });
    });
});
</script>

  @endpush
</x-app-layout>
