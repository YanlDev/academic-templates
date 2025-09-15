<x-public-layout>
    <x-slot name="title">Inicio</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Potencia tu
                    <span class="text-yellow-400">Éxito Académico</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100 max-w-3xl mx-auto">
                    Plantillas Excel profesionales, servicios académicos y cursos especializados
                    para estudiantes y profesionales
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <!-- ✅ CAMBIADO: Enlaces temporales -->
                    <a href="#"
                       class="bg-yellow-400 text-blue-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition-colors inline-flex items-center justify-center">
                        <i class="fas fa-file-excel mr-2"></i>
                        Explorar Plantillas
                    </a>
                    <a href="#"
                       class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors inline-flex items-center justify-center">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        Ver Servicios
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Estadísticas -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">{{ $stats['templates_count'] }}+</div>
                    <div class="text-gray-600">Plantillas Excel</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-green-600 mb-2">{{ number_format($stats['downloads_count']) }}+</div>
                    <div class="text-gray-600">Descargas</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-purple-600 mb-2">{{ $stats['categories_count'] }}+</div>
                    <div class="text-gray-600">Categorías</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-orange-600 mb-2">{{ number_format($stats['users_count']) }}+</div>
                    <div class="text-gray-600">Usuarios</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Servicios Principales -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    ¿Qué ofrecemos?
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Soluciones completas para tu éxito académico y profesional
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Plantillas Excel -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow group">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-green-200 transition-colors">
                        <i class="fas fa-file-excel text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-900">Plantillas Excel</h3>
                    <p class="text-gray-600 mb-4">Plantillas profesionales con tutoriales y conceptos explicados paso a paso</p>
                    <!-- ✅ CAMBIADO: Link temporal -->
                    <a href="#"
                       class="text-green-600 font-medium hover:text-green-700 inline-flex items-center">
                        Ver Catálogo <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <!-- Servicios Académicos -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow group">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-blue-200 transition-colors">
                        <i class="fas fa-graduation-cap text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-900">Servicios Académicos</h3>
                    <p class="text-gray-600 mb-4">Revisión de tesis, asesorías personalizadas y consultoría académica</p>
                    <!-- ✅ CAMBIADO: Link temporal -->
                    <a href="#"
                       class="text-blue-600 font-medium hover:text-blue-700 inline-flex items-center">
                        Solicitar Cotización <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <!-- Cursos Online -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow group">
                    <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-purple-200 transition-colors">
                        <i class="fas fa-play-circle text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-900">Cursos Online</h3>
                    <p class="text-gray-600 mb-4">Cursos especializados con certificación oficial y contenido actualizado</p>
                    <a href="#"
                       class="text-purple-600 font-medium hover:text-purple-700 inline-flex items-center">
                        Próximamente <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <!-- Turnitin -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow group">
                    <div class="w-16 h-16 bg-orange-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-orange-200 transition-colors">
                        <i class="fas fa-search text-orange-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-900">Revisión Turnitin</h3>
                    <p class="text-gray-600 mb-4">Análisis de similitud y originalidad para documentos académicos</p>
                    <!-- ✅ CAMBIADO: Link temporal -->
                    <a href="#"
                       class="text-orange-600 font-medium hover:text-orange-700 inline-flex items-center">
                        Consultar Servicio <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Plantillas Destacadas -->
    @if($featuredTemplates->count() > 0)
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Plantillas Más Populares
                    </h2>
                    <p class="text-xl text-gray-600">
                        Las plantillas más descargadas por nuestros usuarios
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($featuredTemplates as $template)
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-shadow group">
                            @if($template->main_image)
                                <div class="aspect-w-16 aspect-h-10 bg-gray-100 rounded-t-xl overflow-hidden">
                                    <img src="{{ asset('storage/' . $template->main_image) }}"
                                         alt="{{ $template->name }}"
                                         class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            @endif

                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                {{ $template->category->name }}
                            </span>
                                    <span class="text-sm text-gray-500 capitalize">{{ $template->difficulty }}</span>
                                </div>

                                <h3 class="font-bold text-lg mb-2 text-gray-900 group-hover:text-blue-600 transition-colors">
                                    {{ $template->name }}
                                </h3>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ Str::limit($template->description, 100) }}
                                </p>

                                <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-green-600">
                                S/ {{ number_format($template->price, 2) }}
                            </span>
                                    <!-- ✅ CAMBIADO: Link temporal -->
                                    <a href="#"
                                       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                        Ver Detalles
                                    </a>
                                </div>

                                @if($template->rating > 0)
                                    <div class="flex items-center mt-2">
                                        <div class="flex text-yellow-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= floor($template->rating))
                                                    <i class="fas fa-star text-sm"></i>
                                                @elseif($i == ceil($template->rating) && $template->rating - floor($template->rating) >= 0.5)
                                                    <i class="fas fa-star-half-alt text-sm"></i>
                                                @else
                                                    <i class="far fa-star text-sm"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="text-gray-500 text-sm ml-2">({{ $template->rating }})</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <!-- ✅ CAMBIADO: Link temporal -->
                    <a href="#"
                       class="bg-gray-900 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-800 transition-colors inline-flex items-center">
                        Ver Todas las Plantillas
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Final -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                ¿Listo para potenciar tu productividad?
            </h2>
            <p class="text-xl mb-8 text-blue-100">
                Únete a miles de estudiantes y profesionales que ya confían en nuestras herramientas
            </p>
            <!-- ✅ CAMBIADO: Link temporal -->
            <a href="#"
               class="bg-yellow-400 text-blue-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition-colors inline-flex items-center">
                <i class="fas fa-rocket mr-2"></i>
                Comenzar Ahora
            </a>
        </div>
    </section>
</x-public-layout>
