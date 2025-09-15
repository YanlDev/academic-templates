<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.categories.index')
    ],
    [
        'name' => 'Categorías',
        'route' => route('admin.categories.index')
    ],
    [
        'name' => 'Editar Categoría'
    ]
]">

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Nombre
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $category->name) }}"
                       placeholder="Nombre de la categoría"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Icono (FontAwesome)
                </label>
                <input type="text"
                       name="icon"
                       value="{{ old('icon', $category->icon) }}"
                       placeholder="fa-solid fa-tag"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('icon')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Color
                </label>
                <input type="color"
                       name="color"
                       value="{{ old('color', $category->color) }}"
                       class="w-full h-10 border border-gray-300 rounded-md">
                @error('color')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Orden
                </label>
                <input type="number"
                       name="sort_order"
                       value="{{ old('sort_order', $category->sort_order) }}"
                       min="0"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                @error('sort_order')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                Descripción
            </label>
            <textarea name="description"
                      rows="3"
                      placeholder="Descripción de la categoría"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $category->description) }}</textarea>
            @error('description')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                Estado
            </label>
            <div class="flex space-x-4">
                <label class="flex items-center">
                    <input type="radio" name="active" value="1" {{ old('active', $category->active) == '1' ? 'checked' : '' }} class="mr-2">
                    <span class="text-green-600">Activo</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="active" value="0" {{ old('active', $category->active) == '0' ? 'checked' : '' }} class="mr-2">
                    <span class="text-red-600">Inactivo</span>
                </label>
            </div>
            @error('active')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.categories.index') }}"
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cancelar
            </a>
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Actualizar Categoría
            </button>
        </div>
    </form>
</x-admin-layout>
