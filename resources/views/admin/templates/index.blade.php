<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Plantillas',
    ]
]"
                :actionLink="route('admin.templates.create')"
>
    <x-data-table
        :columnsTable="['ID', 'Nombre', 'Categoría', 'Precio', 'Dificultad', 'Estado', 'Acción']"
        :rows="$templates"
        :fields="['id', 'name', 'category.name', 'formatted_price', 'difficulty', 'active']"
        routeEdit="admin.templates.edit"
        routeDestroy="admin.templates.destroy"
    ></x-data-table>
</x-admin-layout>
