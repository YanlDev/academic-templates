@props(['columnsTable' => [], 'rows' => [], 'fields' => [], 'routeEdit' => null])

<div>
    <!-- Versión de escritorio -->
    <div class="hidden md:block">
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        @foreach($columnsTable as $col)
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{$col}}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @forelse($rows as $row)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            @foreach($fields as $field)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($field === 'active')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            {{ data_get($row, $field) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ data_get($row, $field) ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    @elseif($field === 'color')
                                        <div class="flex items-center">
                                            <div class="w-4 h-4 rounded-full border-2 border-gray-300 mr-2"
                                                 style="background-color: {{ data_get($row, $field) }}"></div>
                                            {{ data_get($row, $field) }}
                                        </div>
                                    @else
                                        {{ data_get($row, $field) }}
                                    @endif
                                </td>
                            @endforeach
                            @if($routeEdit)
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route($routeEdit, $row->id) }}"
                                       class="text-indigo-600 hover:text-indigo-900 transition-colors duration-150">
                                        <i class="fa-solid fa-edit mr-1"></i>Editar
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columnsTable) }}" class="px-6 py-12 text-center text-gray-500">
                                <div class="text-gray-400 mb-2">
                                    <i class="fa-solid fa-inbox text-3xl"></i>
                                </div>
                                No hay datos disponibles
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Versión móvil -->
    <div class="md:hidden space-y-4">
        @forelse($rows as $row)
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                @foreach($fields as $index => $field)
                    <div class="flex justify-between items-center {{ $index > 0 ? 'mt-2 pt-2 border-t border-gray-100' : '' }}">
                        <span class="text-sm font-medium text-gray-500">{{ $columnsTable[$index] ?? $field }}</span>
                        <span class="text-sm text-gray-900 text-right">
                            @if($field === 'active')
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ data_get($row, $field) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ data_get($row, $field) ? 'Activo' : 'Inactivo' }}
                                </span>
                            @elseif($field === 'color')
                                <div class="flex items-center justify-end">
                                    <div class="w-3 h-3 rounded-full border border-gray-300 mr-1"
                                         style="background-color: {{ data_get($row, $field) }}"></div>
                                    <span class="text-xs">{{ data_get($row, $field) }}</span>
                                </div>
                            @else
                                {{ data_get($row, $field) }}
                            @endif
                        </span>
                    </div>
                @endforeach
                @if($routeEdit)
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <a href="{{ route($routeEdit, $row->id) }}"
                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition-colors duration-150">
                            <i class="fa-solid fa-edit mr-2"></i>Editar
                        </a>
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fa-solid fa-inbox text-4xl"></i>
                </div>
                <p class="text-gray-500">No hay datos disponibles</p>
            </div>
        @endforelse
    </div>

    <!-- Paginación, si aplica -->
    @if(method_exists($rows, 'links'))
        <div class="mt-6">
            {{ $rows->links() }}
        </div>
    @endif
</div>
