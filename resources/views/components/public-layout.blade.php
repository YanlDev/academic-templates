@props(['title' => null, 'description' => null])

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title . ' - ' . config('app.name') : config('app.name') . ' - Plantillas Excel y Servicios Académicos' }}</title>

    <meta name="description"
          content="{{ $description ?? 'Plantillas Excel profesionales y servicios académicos para estudiantes y profesionales.' }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/e1238f483a.js" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50">
@livewire('public.navigation')

<main>
    {{ $slot }}
</main>

@include('layouts.partials.public.footer')

@livewireScripts
</body>
</html>
