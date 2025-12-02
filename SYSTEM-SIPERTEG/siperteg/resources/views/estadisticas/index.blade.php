<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
        Estadísticas
      </h2>
      <a href="{{ route('dashboard') }}"
         class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
        Volver
      </a>
    </div>
  </x-slot>

  <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
    @foreach([
      ['id'=>'chartAbonados','title'=>'Abonados','type'=>'pie','colors'=>['#34d399','#f87171']],
      ['id'=>'chartCobros','title'=>'Cobros','type'=>'bar','colors'=>['#60a5fa']],
      ['id'=>'chartFallas','title'=>'Fallas','type'=>'pie','colors'=>['#f87171','#34d399']],
      ['id'=>'chartInstalaciones','title'=>'Instalaciones','type'=>'bar','colors'=>['#34d399','#f87171']],
      ['id'=>'chartDefectos','title'=>'Defectos','type'=>'bar','colors'=>['#60a5fa','#fbbf24','#f472b6']],
    ] as $c)
      <div class="bg-white dark:bg-gray-800 p-4 rounded shadow flex flex-col">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">{{ $c['title'] }}</h3>
        <div class="w-full h-48">
          <canvas id="{{ $c['id'] }}" class="w-full h-full"></canvas>
        </div>
      </div>
    @endforeach
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    window.addEventListener('DOMContentLoaded', () => {
      const datasets = {
        chartAbonados:     { labels: @json($abonadosLabels), data: @json($abonadosData),   type: 'pie', colors: ['#34d399','#f87171'] },
        chartCobros:       { labels: @json($cobrosLabels),   data: @json($cobrosData),     type: 'bar', colors: ['#60a5fa'] },
        chartFallas:       { labels: @json($fallasLabels),   data: @json($fallasData),     type: 'pie', colors: ['#f87171','#34d399'] },
        chartInstalaciones:{ labels: @json($instLabels),     data: @json($instData),       type: 'bar', colors: ['#34d399','#f87171'] },
        chartDefectos:     { labels: @json($defLabels),      data: @json($defData),        type: 'bar', colors: ['#60a5fa','#fbbf24','#f472b6'] },
      };

      Object.entries(datasets).forEach(([id, cfg]) => {
        const ctx = document.getElementById(id).getContext('2d');
        new Chart(ctx, {
          type: cfg.type,
          data: {
            labels: cfg.labels,
            datasets: [{
              label: cfg.type === 'bar' ? '# de registros' : undefined,
              data: cfg.data,
              backgroundColor: cfg.colors
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            ...(cfg.type === 'bar' && {
              scales: {
                x: {
                  ticks: {
                    callback: function(value, index) {
                      let label = this.getLabelForValue(value);
                      if (id === 'chartCobros') {
                        let [anio, mes] = label.split('-');
                        const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
                        return meses[parseInt(mes)-1] + ' ' + anio;
                      }
                      return label;
                    }
                  }
                },
                y: { beginAtZero: true, ticks: { precision: 0 } }
              }
            })
          }
        });
      });
    });
  </script>
</x-app-layout>
