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
        'name' => 'Crear Plantilla'
    ]
]">

    <form action="{{ route('admin.templates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Información básica -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h3 class="text-lg font-semibold mb-4">Información Básica</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Nombre de la Plantilla
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Ej: Dashboard de Ventas 2025"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Categoría
                    </label>
                    <select name="category_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="">Seleccionar categoría</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Precio (S/)
                    </label>
                    <input type="number"
                           name="price"
                           value="{{ old('price') }}"
                           placeholder="25.00"
                           step="0.01"
                           min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Dificultad
                    </label>
                    <select name="difficulty"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="principiante" {{ old('difficulty') == 'principiante' ? 'selected' : '' }}>Principiante</option>
                        <option value="intermedio" {{ old('difficulty', 'intermedio') == 'intermedio' ? 'selected' : '' }}>Intermedio</option>
                        <option value="avanzado" {{ old('difficulty') == 'avanzado' ? 'selected' : '' }}>Avanzado</option>
                    </select>
                    @error('difficulty')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Descripción
                </label>
                <textarea name="description"
                          rows="4"
                          placeholder="Descripción detallada de la plantilla..."
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                          required>{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Archivos -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h3 class="text-lg font-semibold mb-4">Archivos</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Archivo Excel (.xlsx, .xls)
                    </label>
                    <input type="file"
                           name="excel_file"
                           accept=".xlsx,.xls"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('excel_file')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">Máximo 10MB</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Imagen Principal
                    </label>
                    <input type="file"
                           name="main_image"
                           accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('main_image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">JPG, PNG - Máximo 2MB</p>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Imágenes de Preview (opcional)
                </label>
                <input type="file"
                       name="preview_images[]"
                       accept="image/*"
                       multiple
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('preview_images.*')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Múltiples imágenes permitidas - JPG, PNG - 2MB cada una</p>
            </div>
        </div>

        <!-- Características y Videos -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h3 class="text-lg font-semibold mb-4">Contenido Educativo</h3>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Características (una por línea)
                    <span id="features-counter" class="text-blue-600 font-normal text-sm ml-2">0 característica(s)</span>
                </label>
                <textarea name="features_text"
                          rows="4"
                          placeholder="Gráficos dinámicos&#10;Fórmulas avanzadas&#10;Dashboard interactivo&#10;Indicadores KPI"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                          required>{{ old('features_text') }}</textarea>
                @error('features')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Cada línea será una característica. Mínimo 1 requerida.</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Videos de YouTube (uno por línea)
                </label>
                <textarea name="youtube_videos_text"
                          rows="3"
                          placeholder="https://www.youtube.com/watch?v=ejemplo1&#10;https://www.youtube.com/watch?v=ejemplo2"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('youtube_videos_text') }}</textarea>
                @error('youtube_videos')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">URLs completas de YouTube</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Conceptos y Metodología
                </label>
                <textarea name="concepts_explanation"
                          rows="6"
                          placeholder="Explica los conceptos teóricos, metodología utilizada, casos de uso, etc."
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('concepts_explanation') }}</textarea>
                @error('concepts_explanation')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Estado -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h3 class="text-lg font-semibold mb-4">Estado</h3>

            <div class="flex space-x-4">
                <label class="flex items-center">
                    <input type="radio" name="active" value="1" {{ old('active', '1') == '1' ? 'checked' : '' }} class="mr-2">
                    <span class="text-green-600">Activa</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="active" value="0" {{ old('active') == '0' ? 'checked' : '' }} class="mr-2">
                    <span class="text-red-600">Inactiva</span>
                </label>
            </div>
            @error('active')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.templates.index') }}"
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cancelar
            </a>
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Plantilla
            </button>
        </div>
    </form>

    <script>
        // Convertir el textarea de características en array
        document.querySelector('form').addEventListener('submit', function(e) {
            const featuresText = document.querySelector('textarea[name="features_text"]').value;
            const features = featuresText.split('\n')
                .map(line => line.trim())
                .filter(line => line !== '');

            const videosText = document.querySelector('textarea[name="youtube_videos_text"]').value;
            const videos = videosText.split('\n')
                .map(line => line.trim())
                .filter(line => line !== '');

            // Limpiar inputs hidden anteriores si existen
            this.querySelectorAll('input[name^="features["], input[name^="youtube_videos["]').forEach(input => {
                input.remove();
            });

            // Crear inputs hidden para enviar como arrays
            features.forEach((feature, index) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `features[${index}]`;
                input.value = feature;
                this.appendChild(input);
            });

            videos.forEach((video, index) => {
                if (video.includes('youtube.com') || video.includes('youtu.be')) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `youtube_videos[${index}]`;
                    input.value = video;
                    this.appendChild(input);
                }
            });
        });

        // Validación en tiempo real para características
        document.querySelector('textarea[name="features_text"]').addEventListener('input', function(e) {
            const lines = e.target.value.split('\n').filter(line => line.trim() !== '');
            const counter = document.getElementById('features-counter');
            if (counter) {
                counter.textContent = `${lines.length} característica(s)`;
            }
        });
    </script>
</x-admin-layout>
