<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>{{ config('app.name', 'Kundenverwaltung') }}</title>
        <link rel="icon" href="https://www.finas.de/files/icons/android-icon-192x192.png" type="image/png">

        <title>Kundenverwaltung</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet" type="text/css">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css'])
    </head>
    <body class="font-sans antialiased bg-white text-black">
        <div id="app" class="container mx-auto p-4"></div>
        @vite(['resources/js/app.js'])
    </body>
</html>
