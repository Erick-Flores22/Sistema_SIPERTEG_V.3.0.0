<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo (redirige al dashboard) -->
                <div class="shrink-0 flex items-center space-x-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <img src="{{ asset('storage/logo_siperteg.png') }}" alt="Logo Empresa" class="h-12 w-auto object-contain">
                        <span class="text-xl font-semibold text-gray-800 dark:text-gray-200 tracking-wide">SIPERTEG</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @php
                        $role = Auth::user()->role ?? null;

                        // Definir enlaces por rol
                        $links = [];

                        if ($role === 'admin') {
                            $links = [
                                ['route' => 'abonados.index', 'label' => 'Abonados'],
                                ['route' => 'gestiones.index', 'label' => 'Cobros', 'active' => ['gestiones.*','periodos.*','cobros.*']],
                                ['route' => 'planes.index', 'label' => 'Planes'],
                                ['route' => 'fallas.index', 'label' => 'Fallas'],
                                ['route' => 'instalaciones.index', 'label' => 'Instalaciones'],
                                ['route' => 'defectos.index', 'label' => 'Defectos'],
                                ['route' => 'nodos.index', 'label' => 'Nodos'],
                                ['route' => 'cajas_distribucion.index', 'label' => 'Cajas'],
                                ['route' => 'estadisticas.index', 'label' => 'Estadísticas'],
                                ['route' => 'users.index', 'label' => 'Usuarios'],
                            ];
                        } elseif ($role === 'cobrador') {
                            $links = [
                                ['route' => 'gestiones.index', 'label' => 'Cobros', 'active' => ['gestiones.*','periodos.*','cobros.*']],
                            ];
                        } elseif ($role === 'tecnico') {
                            $links = [
                                ['route' => 'abonados.index', 'label' => 'Abonados'],
                                ['route' => 'planes.index', 'label' => 'Planes'],
                                ['route' => 'fallas.index', 'label' => 'Fallas'],
                                ['route' => 'defectos.index', 'label' => 'Defectos'],
                                ['route' => 'instalaciones.index', 'label' => 'Instalaciones'],
                                ['route' => 'nodos.index', 'label' => 'Nodos'],
                                ['route' => 'cajas_distribucion.index', 'label' => 'Cajas'],
                            ];
                        } elseif ($role === 'asistente') {
                            // Instalaciones, Defectos y Planes
                            $links = [
                                ['route' => 'instalaciones.index', 'label' => 'Instalaciones'],
                                ['route' => 'defectos.index', 'label' => 'Defectos'],
                                ['route' => 'planes.index', 'label' => 'Planes'],
                            ];
                        }
                    @endphp

                    {{-- Renderizar enlaces sin repeticiones --}}
                    @foreach($links as $link)
                        @php
                            $activeRoutes = $link['active'] ?? [$link['route']];
                            $isActive = false;
                            foreach ($activeRoutes as $r) {
                                if(request()->routeIs($r)) {
                                    $isActive = true;
                                    break;
                                }
                            }
                        @endphp
                        <x-nav-link :href="route($link['route'])" :active="$isActive">
                            {{ __($link['label']) }}
                        </x-nav-link>
                    @endforeach
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
