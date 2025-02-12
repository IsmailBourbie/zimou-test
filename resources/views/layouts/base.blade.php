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
        @livewireStyles
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
        @livewireScripts
    </body>
</html>
