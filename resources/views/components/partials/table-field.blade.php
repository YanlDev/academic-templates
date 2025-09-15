@if($field === 'active')
    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
        {{ data_get($row, $field) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
        {{ data_get($row, $field) ? 'Activo' : 'Inactivo' }}
    </span>
@elseif($field === 'color')
    <div class="flex items-center">
        <div class="w-4 h-4 rounded-full border-2 border-gray-300 mr-2"
             style="background-color: {{ data_get($row, $field) }}"></div>
        <span class="text-xs text-gray-600">{{ data_get($row, $field) }}</span>
    </div>
@elseif($field === 'difficulty')
    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
        @if(data_get($row, $field) === 'principiante') bg-green-100 text-green-800
        @elseif(data_get($row, $field) === 'intermedio') bg-yellow-100 text-yellow-800
        @elseif(data_get($row, $field) === 'avanzado') bg-red-100 text-red-800
        @else bg-gray-100 text-gray-800 @endif">
        {{ ucfirst(data_get($row, $field)) }}
    </span>
@elseif($field === 'formatted_price')
    <span class="font-semibold text-green-600">
        {{ data_get($row, $field) ?? ('S/ ' . number_format(data_get($row, 'price'), 2)) }}
    </span>
@elseif($field === 'category.name')
    <span class="text-sm text-gray-900">
        {{ data_get($row, $field) }}
    </span>

@elseif(str_contains($field, '.'))
    <span class="text-sm text-gray-900">
        {{ data_get($row, $field) }}
    </span>
@else
    <span class="text-sm text-gray-900" title="{{ data_get($row, $field) }}">
        {{ Str::limit(data_get($row, $field) ?? 'N/A', 30) }}
    </span>
@endif
