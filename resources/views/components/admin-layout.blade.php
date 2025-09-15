@props(['breadcrumbs' => [], 'actionLink' => null])
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/e1238f483a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased"
      x-data="{
        sidebarOpen: false
      }"
      :class="{
        'overflow-y-hidden': sidebarOpen
      }"
>
<!-- Cortina negra para móvil -->
<div x-show="sidebarOpen"
     x-cloak
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false"
     class="fixed inset-0 bg-gray-900 bg-opacity-75 z-30 sm:hidden">
</div>

@include('layouts.partials.admin.navbar')
@include('layouts.partials.admin.sidebar')

<div class="transition-all duration-300 p-4 sm:ml-64">
    <div class="mt-14">
        @include('layouts.partials.admin.breadcrum')
        <div class="p-4 bg-gray-50 min-h-screen">
            {{$slot}}
        </div>
    </div>
</div>

@livewireScripts
@stack('warning-alert')
@stack('js')
@if(session('swal'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swalConfig = @json(session('swal'));
            Swal.fire(swalConfig)
        })
    </script>
@endif
<script>
    Livewire.on('swal', data => {
        Swal.fire(data[0])
    });
</script>

</body>
</html>
