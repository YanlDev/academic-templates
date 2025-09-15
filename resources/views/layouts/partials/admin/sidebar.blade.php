<?php
$links = [
    [
        'icon' => 'fa-solid fa-gauge',
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
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
        'url' => route('admin.templates.index'),
        'active' => request()->routeIs('admin.templates.*')
    ]
]
?>

    <!-- Sidebar -->
<aside id="logo-sidebar"
       x-transition:enter="transform transition ease-in-out duration-300"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transform transition ease-in-out duration-300"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full"
       :class="{
        'translate-x-0': sidebarOpen,
        '-translate-x-full': !sidebarOpen
       }"
       class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transform bg-white border-r border-gray-200 sm:translate-x-0 transition-transform duration-300 ease-in-out"
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
