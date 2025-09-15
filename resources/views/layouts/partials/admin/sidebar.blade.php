<?php
$links = [
    [
        'icon' => 'fa-solid fa-gauge',
        'name' => 'Dashboard',
        'url' => route('admin.categories.index'), // Por ahora, después haremos admin.dashboard
        'active' => request()->routeIs('admin.dashboard')
    ],
    [
        'icon' => 'fa-solid fa-tag',
        'name' => 'Categorías',
        'url' => route('admin.categories.index'),
        'active' => request()->routeIs('admin.categories.*')
    ],
    [
        'icon' => 'fa-solid fa-file-excel',
        'name' => 'Plantillas',
        'url' => '#', // Después: route('admin.templates.index')
        'active' => request()->routeIs('admin.templates.*')
    ]
]
?>

    <!-- Sidebar -->
<aside id="logo-sidebar"
       :class="{
        'translate-x-0 ease-out': sidebarOpen,
        '-translate-x-full ease-in': !sidebarOpen
       }"
       class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200 sm:translate-x-0"
       aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            @foreach($links as $link)
                <li>
                    <a href="{{$link['url']}}"
                       class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ $link['active'] ? 'bg-gray-200 ' : '' }}">
                        <span class="inline-flex w-6 h-6 items-center justify-center text-gray-900">
                            <i class="{{$link['icon']}}"></i>
                        </span>
                        <span class="ms-3">{{$link['name']}}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
