<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
        <title>{{ $title ?? 'Laravel' }}</title>

        <!-- Scripts -->
{{--        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-slate-50">
            <!-- Navigation -->
            @php
                $user = auth()->user();
            @endphp

            <x-navbar :user="$user"/>

            <!-- Page Content -->
            <main class="pt-16">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
