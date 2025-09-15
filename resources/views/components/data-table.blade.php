@props(['columnsTable' => [], 'rows' => [], 'fields' => [], 'routeEdit' => null, 'routeDestroy' => null])

<div class="w-full">
    <!-- Vista Desktop - Tabla tradicional -->
    <div class="hidden lg:block">
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        @foreach($columnsTable as $col)
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ $col }}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($rows as $row)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            @foreach($fields as $field)
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @include('components.partials.table-field', ['field' => $field, 'row' => $row])
                                </td>
                            @endforeach
                            @if($routeEdit || $routeDestroy)
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @include('components.partials.table-actions', ['row' => $row, 'routeEdit' => $routeEdit, 'routeDestroy' => $routeDestroy])
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columnsTable) }}" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m0 0V9a2 2 0 012-2h2m0 0V6a2 2 0 012-2h2a2 2 0 012 2v1m0 0v2a2 2 0 002 2h2m0 0v.01"></path>
                                    </svg>
                                    <p class="text-gray-500 text-lg font-medium">No hay datos disponibles</p>
                                    <p class="text-gray-400 text-sm">Los registros aparecerán aquí una vez que agregues contenido</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Vista Tablet - Tabla compacta -->
    <div class="hidden md:block lg:hidden">
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        @foreach(array_slice($columnsTable, 0, -1) as $col) <!-- Oculta última columna (acciones) -->
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ $col }}
                            </th>
                        @endforeach
                        @if($routeEdit || $routeDestroy)
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones
                            </th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($rows as $row)
                        <tr class="hover:bg-gray-50">
                            @foreach(array_slice($fields, 0, -1) as $field) <!-- Muestra campos principales -->
                                <td class="px-4 py-3 text-sm">
                                    @include('components.partials.table-field', ['field' => $field, 'row' => $row])
                                </td>
                            @endforeach
                            @if($routeEdit || $routeDestroy)
                                <td class="px-4 py-3 text-sm">
                                    @include('components.partials.table-actions-compact', ['row' => $row, 'routeEdit' => $routeEdit, 'routeDestroy' => $routeDestroy])
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columnsTable) }}" class="px-4 py-8 text-center text-gray-500">
                                <p>No hay datos disponibles</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Vista Móvil - Cards responsivas -->
    <div class="md:hidden space-y-4">
        @forelse($rows as $row)
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 hover:shadow-md transition-shadow duration-200">
                <!-- Encabezado del card -->
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-gray-900 truncate">
                            {{ data_get($row, $fields[1] ?? $fields[0]) }} <!-- Segundo campo como título -->
                        </h3>
                        @if(isset($fields[2]))
                            <p class="text-xs text-gray-500 mt-1">
                                {{ Str::limit(data_get($row, $fields[2]), 40) }}
                            </p>
                        @endif
                    </div>
                    @if($routeEdit || $routeDestroy)
                        <div class="ml-3">
                            @include('components.partials.table-actions-mobile', ['row' => $row, 'routeEdit' => $routeEdit, 'routeDestroy' => $routeDestroy])
                        </div>
                    @endif
                </div>

                <!-- Contenido del card -->
                <div class="space-y-2">
                    @foreach($fields as $index => $field)
                        @if($index > 0 && $index < count($fields) - 1) <!-- Omite ID y último campo -->
                            <div class="flex justify-between items-center py-1 border-b border-gray-100 last:border-b-0">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    {{ $columnsTable[$index] ?? Str::title(str_replace(['_', '.'], [' ', ' '], $field)) }}
                                </span>
                                <div class="text-sm text-gray-900 text-right max-w-[60%]">
                                    @include('components.partials.table-field', ['field' => $field, 'row' => $row])
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- ID Badge (opcional) -->
                <div class="mt-3 flex justify-between items-center">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                        ID: {{ data_get($row, $fields[0]) }}
                    </span>
                    @if(method_exists($row, 'created_at'))
                        <span class="text-xs text-gray-400">
                            {{ $row->created_at->format('d/m/Y') }}
                        </span>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m0 0V9a2 2 0 012-2h2m0 0V6a2 2 0 012-2h2a2 2 0 012 2v1m0 0v2a2 2 0 002 2h2m0 0v.01"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-1">No hay datos disponibles</h3>
                <p class="text-gray-500">Los registros aparecerán aquí una vez que agregues contenido</p>
            </div>
        @endforelse
    </div>

    <!-- Paginación responsiva -->
    @if(method_exists($rows, 'links'))
        <div class="mt-6">
            <div class="bg-white px-4 py-3 border border-gray-200 rounded-lg shadow-sm">
                {{ $rows->onEachSide(1)->links('components.partials.custom-pagination') }}
            </div>
        </div>
    @endif
</div>

<script>
    function confirmDelete(button) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mx-2",
                cancelButton: "bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mx-2"
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: "¿Estás seguro?",
            text: "No podrás revertir esta acción!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();

                swalWithBootstrapButtons.fire({
                    title: "Eliminado!",
                    text: "La categoría ha sido eliminada.",
                    icon: "success"
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelado",
                    text: "Tu categoría está a salvo :)",
                    icon: "error"
                });
            }
        });
    }
</script>
