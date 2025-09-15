<nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo y Navegación Principal -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <div
                            class="h-8 w-8 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-sm"></i>
                        </div>
                        <span class="ml-2 text-xl font-bold text-gray-900">Academia Excel</span>
                    </a>
                </div>

                <!-- Navegación Desktop -->
                <div class="hidden md:ml-8 md:flex md:space-x-8">
                    <a href="{{ route('home') }}"
                       class="text-gray-900 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors
                              {{ request()->routeIs('home') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                        Inicio
                    </a>

                    <!-- Dropdown Plantillas -->
                    <div class="relative" x-data="{ openDropdown: false }">
                        <button @click="openDropdown = !openDropdown"
                                class="text-gray-500 hover:text-blue-600 px-3 py-2 text-sm font-medium flex items-center transition-colors">
                            Plantillas
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>

                        <div x-show="openDropdown"
                             @click.away="openDropdown = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                <a href="#"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-th-large mr-2"></i>Ver Todas
                                </a>
                                @foreach($categories as $category)
                                    <a href="#"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                        <i class="fas fa-folder mr-2"></i>{{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <a href="#"
                       class="text-gray-500 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors
                              {{ request()->routeIs('services.*') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                        Servicios Académicos
                    </a>

                    <a href="#"
                       class="text-gray-500 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">
                        Nosotros
                    </a>

                    <a href="#"
                       class="text-gray-500 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">
                        Contacto
                    </a>
                </div>
            </div>

            <!-- Acciones de Usuario -->
            <div class="flex items-center space-x-4">
                <!-- Carrito -->
                <button wire:click="$emit('toggleCart')"
                        class="relative p-2 text-gray-500 hover:text-blue-600 transition-colors">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    @if($cartCount > 0)
                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                    @endif
                </button>

                <!-- Usuario -->
                @auth
                    <div class="relative" x-data="{ userMenu: false }">
                        <button @click="userMenu = !userMenu"
                                class="flex items-center text-gray-500 hover:text-blue-600 transition-colors">
                            @if(Auth::user()->profile_photo_path)
                                <img src="{{ Auth::user()->profile_photo_url }}"
                                     alt="{{ Auth::user()->name }}"
                                     class="w-8 h-8 rounded-full object-cover">
                            @else
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-gray-600 text-sm"></i>
                                </div>
                            @endif
                            <span class="ml-2 text-sm font-medium hidden sm:block">{{ Auth::user()->name }}</span>
                        </button>

                        <div x-show="userMenu"
                             @click.away="userMenu = false"
                             class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                <a href="#"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
                                    <i class="fas fa-tachometer-alt mr-2"></i>Mi Cuenta
                                </a>
                                <a href="#"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
                                    <i class="fas fa-download mr-2"></i>Mis Compras
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('login') }}"
                           class="text-gray-500 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">
                            Ingresar
                        </a>
                        <a href="{{ route('register') }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                            Registrarse
                        </a>
                    </div>
                @endauth

                <!-- Botón móvil -->
                <button @click="open = !open"
                        class="md:hidden p-2 text-gray-500 hover:text-blue-600">
                    <i class="fas fa-bars" x-show="!open"></i>
                    <i class="fas fa-times" x-show="open"></i>
                </button>
            </div>
        </div>

        <!-- Menú móvil -->
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="md:hidden border-t border-gray-200 bg-white">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}"
                   class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-blue-50 rounded-md">
                    Inicio
                </a>
                <a href="#"
                   class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-blue-50 rounded-md">
                    Plantillas
                </a>
                <a href="#"
                   class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-blue-50 rounded-md">
                    Servicios
                </a>
                <a href="#"
                   class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-blue-50 rounded-md">
                    Nosotros
                </a>
                <a href="#"
                   class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-blue-50 rounded-md">
                    Contacto
                </a>
            </div>
        </div>
    </div>
</nav>
