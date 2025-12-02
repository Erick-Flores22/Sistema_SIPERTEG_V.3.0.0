{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900 p-6">
    {{-- Encabezado --}}
    <div class="flex items-center justify-between mb-8">
      <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Panel de Control</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Bienvenido al sistema administrativo de SIPERTEG
        </p>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow px-6 py-3">
        <p class="text-sm text-gray-500 dark:text-gray-400">Usuario actual</p>
        <p class="text-lg font-semibold text-gray-800 dark:text-white">{{ auth()->user()->name }}</p>
      </div>
    </div>

    {{-- Tarjetas de estadísticas --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-6">
      {{-- Abonados --}}
      <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow hover:shadow-lg transition duration-300">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total Abonados</p>
            <h2 class="text-3xl font-bold text-blue-600 mt-2">{{ \App\Models\Abonado::count() }}</h2>
          </div>
          <div class="bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-300 p-3 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a2 2 0 00-2-2h-3v4zM9 20H4v-2a2 2 0 012-2h3v4zM12 4a2 2 0 00-2 2v12a2 2 0 002 2 2 2 0 002-2V6a2 2 0 00-2-2z" />
            </svg>
          </div>
        </div>
      </div>

      {{-- Fallas --}}
      <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow hover:shadow-lg transition duration-300">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total Fallas</p>
            <h2 class="text-3xl font-bold text-purple-600 mt-2">{{ \App\Models\Falla::count() }}</h2>
          </div>
          <div class="bg-purple-100 dark:bg-purple-900/40 text-purple-600 dark:text-purple-300 p-3 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 12v.01M12 4v16" />
            </svg>
          </div>
        </div>
      </div>

      {{-- Fallas Pendientes --}}
      <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow hover:shadow-lg transition duration-300">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Fallas Pendientes</p>
            <h2 class="text-3xl font-bold text-yellow-500 mt-2">{{ \App\Models\Falla::where('estado','pendiente')->count() }}</h2>
          </div>
          <div class="bg-yellow-100 dark:bg-yellow-900/40 text-yellow-600 dark:text-yellow-300 p-3 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
        </div>
      </div>

      {{-- Instalaciones --}}
      <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow hover:shadow-lg transition duration-300">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Instalaciones</p>
            <h2 class="text-3xl font-bold text-indigo-600 mt-2">{{ \App\Models\Instalacion::count() }}</h2>
          </div>
          <div class="bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-300 p-3 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m4-4H8" />
            </svg>
          </div>
        </div>
      </div>

      {{-- Defectos --}}
      <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow hover:shadow-lg transition duration-300">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Defectos</p>
            <h2 class="text-3xl font-bold text-pink-600 mt-2">{{ \App\Models\Defecto::count() }}</h2>
          </div>
          <div class="bg-pink-100 dark:bg-pink-900/40 text-pink-600 dark:text-pink-300 p-3 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
          </div>
        </div>
      </div>

      {{-- Nodos --}}
      <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow hover:shadow-lg transition duration-300">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Nodos</p>
            <h2 class="text-3xl font-bold text-teal-600 mt-2">{{ \App\Models\Nodo::count() }}</h2>
          </div>
          <div class="bg-teal-100 dark:bg-teal-900/40 text-teal-600 dark:text-teal-300 p-3 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </div>
        </div>
      </div>

      
    </div>

    {{-- Resumen general --}}
    <div class="mt-10 bg-white dark:bg-gray-800 rounded-xl shadow p-6">
      <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Resumen General</h2>
      <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
          <tr>
            <th class="px-6 py-3">Indicador</th>
            <th class="px-6 py-3 text-right">Valor</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-b dark:border-gray-700">
            <td class="px-6 py-3">Total de Abonados</td>
            <td class="px-6 py-3 text-right">{{ \App\Models\Abonado::count() }}</td>
          </tr>
          <tr class="border-b dark:border-gray-700">
            <td class="px-6 py-3">Fallas Pendientes</td>
            <td class="px-6 py-3 text-right">{{ \App\Models\Falla::where('estado','pendiente')->count() }}</td>
          </tr>
          <tr class="border-b dark:border-gray-700">
            <td class="px-6 py-3">Fallas Resueltas</td>
            <td class="px-6 py-3 text-right">{{ \App\Models\Falla::where('estado','resuelta')->count() }}</td>
          </tr>
          <tr>
            <td class="px-6 py-3">Instalaciones Totales</td>
            <td class="px-6 py-3 text-right">{{ \App\Models\Instalacion::count() }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>
