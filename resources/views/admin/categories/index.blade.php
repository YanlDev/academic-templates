<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Categorías',
    ]
]"
                :actionLink="route('admin.categories.create')"
>
    <x-data-table
        :columnsTable="['ID', 'Nombre', 'Slug', 'Color', 'Orden', 'Estado', 'Acción']"
        :rows="$categories"
        :fields="['id', 'name', 'slug', 'color', 'sort_order', 'active']"
        routeEdit="admin.categories.edit"
        routeDestroy="admin.categories.destroy"
    ></x-data-table>
</x-admin-layout>
