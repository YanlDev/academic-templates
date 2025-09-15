@props(['columnsTable' => [], 'rows' => [], 'fields' => [], 'routeEdit' => null, 'routeDestroy' => null])

<div>
    <div class="relative overflow-x-auto mb-4 card">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                @foreach($columnsTable as $col)
                    <th scope="col" class="px-6 py-3">
                        {{$col}}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $row)
                <tr class="bg-white border-b border-gray-200">
                    @foreach($fields as $field)
                        <td class="px-6 py-4">
                            @if($field === 'active')
                                <span class="px-2 py-1 text-xs rounded-full {{ $row->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $row->active ? 'Activo' : 'Inactivo' }}
                                </span>
                            @elseif($field === 'color')
                                <div class="flex items-center">
                                    <div class="w-6 h-6 rounded-full mr-2" style="background-color: {{ data_get($row, $field) }}"></div>
                                    {{ data_get($row, $field) }}
                                </div>
                            @elseif($field === 'difficulty')
                                <span class="px-2 py-1 text-xs font-medium rounded-full
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
                            @else
                                <span class="truncate" title="{{ data_get($row, $field) }}">
                                    {{ Str::limit(data_get($row, $field) ?? 'N/A', 30) }}
                                </span>
                            @endif
                        </td>
                    @endforeach

                    @if($routeEdit || $routeDestroy)
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                @if($routeEdit)
                                    <a href="{{ route($routeEdit, $row->id) }}"
                                       class="text-blue-500 hover:underline mr-2">
                                        Editar
                                    </a>
                                @endif

                                @if($routeDestroy)
                                    <form action="{{ route($routeDestroy, $row->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                onclick="confirmDelete(this)"
                                                class="text-red-500 hover:underline">
                                            Eliminar
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @if(method_exists($rows, 'links'))
        <div class="mt-4">
            {{ $rows->links() }}
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
