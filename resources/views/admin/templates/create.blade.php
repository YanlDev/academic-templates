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

    <form action="{{ route('admin.templates.store') }}" method="POST" enctype="multipart/form-data" id="template-form">
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

        <!-- Archivos con Preview -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h3 class="text-lg font-semibold mb-4">Archivos</h3>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Archivo Excel con Preview -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Archivo Excel (.xlsx, .xls)
                    </label>
                    <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition-colors">
                        <input type="file"
                               name="excel_file"
                               id="excel_file"
                               accept=".xlsx,.xls"
                               class="hidden"
                               required
                               onchange="handleExcelUpload(this)">
                        <label for="excel_file" class="cursor-pointer">
                            <div id="excel-upload-area">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <p class="mt-2 text-sm text-gray-600">
                                    <span class="font-medium text-blue-600 hover:text-blue-500">Haz clic para subir</span>
                                    o arrastra el archivo
                                </p>
                                <p class="text-xs text-gray-500">Excel (máx. 10MB)</p>
                            </div>
                            <div id="excel-preview" class="hidden">
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900" id="excel-name"></p>
                                        <p class="text-xs text-gray-500" id="excel-size"></p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('excel_file')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Imagen Principal con Preview -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Imagen Principal
                    </label>
                    <div class="relative">
                        <div class="w-full h-64 bg-gray-100 rounded-lg border-2 border-dashed border-gray-300 hover:border-blue-500 transition-colors flex items-center justify-center overflow-hidden">
                            <div id="main-image-placeholder" class="text-center p-4">
                                <svg class="h-16 w-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm text-gray-500">Imagen principal</p>
                            </div>
                            <img id="main-image-preview" class="w-full h-full object-cover hidden" alt="Vista previa">
                        </div>

                        <label for="main_image" class="absolute top-3 right-3 px-3 py-2 bg-white rounded-md shadow-sm hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer transition-all">
                            <div class="flex items-center space-x-2">
                                <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-sm text-gray-600">Subir</span>
                            </div>
                        </label>

                        <input type="file"
                               name="main_image"
                               id="main_image"
                               accept="image/*"
                               class="hidden"
                               required
                               onchange="previewMainImage(this)">
                    </div>
                    @error('main_image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Imágenes de Preview Múltiples -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Imágenes de Preview (opcional)
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition-colors">
                    <input type="file"
                           name="preview_images[]"
                           id="preview_images"
                           accept="image/*"
                           multiple
                           class="hidden"
                           onchange="previewMultipleImages(this)">
                    <label for="preview_images" class="cursor-pointer">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="mt-2 text-sm text-gray-600">
                            <span class="font-medium text-blue-600 hover:text-blue-500">Haz clic para subir múltiples imágenes</span>
                            o arrastra los archivos
                        </p>
                        <p class="text-xs text-gray-500">PNG, JPG (máx. 2MB cada una)</p>
                    </label>
                </div>

                <div id="preview-images-container" class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 hidden"></div>

                @error('preview_images.*')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Contenido Educativo -->
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
                          required
                          oninput="countFeatures(this)">{{ old('features_text') }}</textarea>
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
        // Preview de imagen principal
        function previewMainImage(input) {
            const preview = document.getElementById('main-image-preview');
            const placeholder = document.getElementById('main-image-placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Preview de múltiples imágenes
        function previewMultipleImages(input) {
            const container = document.getElementById('preview-images-container');
            container.innerHTML = '';

            if (input.files && input.files.length > 0) {
                container.classList.remove('hidden');

                Array.from(input.files).forEach((file, index) => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imageDiv = document.createElement('div');
                        imageDiv.className = 'relative group';
                        imageDiv.innerHTML = `
                            <img src="${e.target.result}"
                                 alt="Preview ${index + 1}"
                                 class="w-full h-24 object-cover rounded-lg border-2 border-gray-200">
                            <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                <span class="text-white text-xs">Preview ${index + 1}</span>
                            </div>
                        `;
                        container.appendChild(imageDiv);
                    };

                    reader.readAsDataURL(file);
                });
            } else {
                container.classList.add('hidden');
            }
        }

        // Manejo de archivo Excel
        function handleExcelUpload(input) {
            const uploadArea = document.getElementById('excel-upload-area');
            const preview = document.getElementById('excel-preview');
            const nameElement = document.getElementById('excel-name');
            const sizeElement = document.getElementById('excel-size');

            if (input.files && input.files[0]) {
                const file = input.files[0];

                nameElement.textContent = file.name;
                sizeElement.textContent = formatFileSize(file.size);

                uploadArea.classList.add('hidden');
                preview.classList.remove('hidden');
            }
        }

        // Contador de características
        function countFeatures(textarea) {
            const lines = textarea.value.split('\n').filter(line => line.trim() !== '');
            document.getElementById('features-counter').textContent = `${lines.length} característica(s)`;
        }

        // Formatear tamaño de archivo
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Convertir el textarea de características en array (manteniendo tu lógica original)
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

        // Inicializar contador al cargar
        document.addEventListener('DOMContentLoaded', function() {
            const featuresTextarea = document.querySelector('textarea[name="features_text"]');
            if (featuresTextarea) {
                countFeatures(featuresTextarea);
            }
        });
    </script>
</x-admin-layout>
