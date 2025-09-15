<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Plantillas',
        'route' => route('admin.templates.index')
    ],
    [
        'name' => $template->name
    ]
]">

    <div class="space-y-6">
        <!-- Header con acciones -->
        <div class="bg-white p-6 rounded-lg shadow-sm border">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-2">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $template->name }}</h1>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            {{ $template->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $template->active ? 'Activo' : 'Inactivo' }}
                        </span>
                        @if($template->featured)
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Destacado
                            </span>
                        @endif
                    </div>
                    <p class="text-gray-600">{{ $template->description }}</p>
                </div>
                <div class="mt-4 lg:mt-0 flex space-x-3">
                    <a href="{{ route('admin.templates.edit', $template) }}"
                       class="btn-primary">
                        <i class="fa-solid fa-edit mr-2"></i>Editar
                    </a>
                    <a href="{{ route('admin.templates.index') }}"
                       class="btn-secondary">
                        <i class="fa-solid fa-arrow-left mr-2"></i>Volver
                    </a>
                </div>
            </div>
        </div>

        <!-- Información básica y archivos -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Información básica -->
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <h2 class="text-lg font-semibold mb-4">Información Básica</h2>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Categoría</dt>
                        <dd class="text-sm text-gray-900">{{ $template->category->name ?? 'Sin categoría' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Precio</dt>
                        <dd class="text-sm font-semibold text-green-600">{{ $template->formatted_price }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Dificultad</dt>
                        <dd>
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                {{ $template->difficulty_badge['color'] === 'green' ? 'bg-green-100 text-green-800' :
                                   ($template->difficulty_badge['color'] === 'yellow' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ $template->difficulty_badge['text'] }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Slug</dt>
                        <dd class="text-sm text-gray-900 font-mono">{{ $template->slug }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Descargas</dt>
                        <dd class="text-sm text-gray-900">{{ number_format($template->downloads ?? 0) }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Calificación</dt>
                        <dd class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= ($template->rating ?? 0))
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endif
                            @endfor
                            <span class="ml-2 text-sm text-gray-600">({{ number_format($template->rating ?? 0, 1) }})</span>
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Archivos -->
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <h2 class="text-lg font-semibold mb-4">Archivos</h2>
                <div class="space-y-4">
                    <!-- Archivo Excel -->
                    @if($template->excel_file)
                        <div class="flex items-center p-3 bg-green-50 rounded-lg border border-green-200">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-green-900">Archivo Excel</p>
                                <p class="text-sm text-green-700">{{ basename($template->excel_file) }}</p>
                            </div>
                            <a href="{{ $template->excel_file_url }}" target="_blank"
                               class="text-green-600 hover:text-green-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </a>
                        </div>
                    @endif

                    <!-- Imagen principal -->
                    @if($template->main_image)
                        <div class="space-y-2">
                            <h3 class="text-sm font-medium text-gray-900">Imagen Principal</h3>
                            <div class="relative">
                                <img src="{{ $template->main_image_url }}"
                                     alt="{{ $template->name }}"
                                     class="w-full h-48 object-cover rounded-lg border border-gray-200">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Características -->
        @if($template->features && count($template->features) > 0)
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <h2 class="text-lg font-semibold mb-4">Características</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach($template->features as $feature)
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-sm text-gray-900">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Imágenes de Preview -->
        @if($template->preview_images && count($template->preview_images) > 0)
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <h2 class="text-lg font-semibold mb-4">Imágenes de Preview</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($template->preview_image_urls as $index => $imageUrl)
                        <div class="relative group">
                            <img src="{{ $imageUrl }}"
                                 alt="Preview {{ $index + 1 }}"
                                 class="w-full h-24 object-cover rounded-lg border border-gray-200 hover:scale-105 transition-transform duration-200">
                            <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                <span class="text-white text-xs font-medium">Preview {{ $index + 1 }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Videos de YouTube -->
        @if($template->youtube_videos && count($template->youtube_videos) > 0)
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <h2 class="text-lg font-semibold mb-4">Videos de YouTube</h2>
                <div class="space-y-3">
                    @foreach($template->youtube_videos as $index => $video)
                        <div class="flex items-center p-3 bg-red-50 rounded-lg border border-red-200">
                            <svg class="w-6 h-6 text-red-600 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                            <a href="{{ $video }}" target="_blank"
                               class="text-sm text-gray-900 hover:text-blue-600 transition-colors">
                                Video {{ $index + 1 }}: {{ $video }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Conceptos y Metodología -->
        @if($template->concepts_explanation)
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <h2 class="text-lg font-semibold mb-4">Conceptos y Metodología</h2>
                <div class="prose max-w-none">
                    <p class="text-gray-700 whitespace-pre-line">{{ $template->concepts_explanation }}</p>
                </div>
            </div>
        @endif

        <!-- Fechas -->
        <div class="bg-white p-6 rounded-lg shadow-sm border">
            <h2 class="text-lg font-semibold mb-4">Fechas</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Creado</dt>
                    <dd class="text-sm text-gray-900">{{ $template->created_at->format('d/m/Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Última actualización</dt>
                    <dd class="text-sm text-gray-900">{{ $template->updated_at->format('d/m/Y H:i') }}</dd>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>