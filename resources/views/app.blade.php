<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
        <!-- Scripts -->
        @routes
        @viteReactRefresh
        @vite(['resources/js/app.jsx', "resources/js/Pages/{$page['component']}.jsx"])
        @inertiaHead

        <link rel="icon" type="image/x-icon" href="/assets/pizza_kraken_favicon.jpg">
        <script async data-id="101478560" src="/b6eb809d57.js"></script>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
