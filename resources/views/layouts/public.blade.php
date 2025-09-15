<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') . ' - Plantillas Excel y Servicios Académicos' }}</title>

<!-- SEO Meta Tags -->
<meta name="description" content="{{ $description ?? 'Plantillas Excel profesionales y servicios académicos. Mejora tu productividad con nuestras herramientas educativas.' }}">
<meta name="keywords" content="plantillas excel, servicios académicos, educación, productividad">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet"/>
<script src="https://kit.fontawesome.com/e1238f483a.js" crossorigin="anonymous"></script>

@stack('css')

<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50">
<!-- Navegación -->
@livewire('public.navigation')

<!-- Contenido Principal -->
<main>
    {{ $slot }}
</main>

<!-- Footer -->
@include('layouts.partials.public.footer')

<!-- Carrito Sidebar -->
<div id="cart-sidebar" class="hidden">
    @livewire('public.cart-sidebar')
</div>

@stack('modals')
@stack('js')
@livewireScripts
</body>
</html>
