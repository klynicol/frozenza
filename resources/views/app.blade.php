<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="{{ $page['props']['meta']['description'] }}" />

        <meta property="og:title" content="{{ $page['props']['meta']['title'] }}" />
        <meta property="og:description" content="{{ $page['props']['meta']['description'] }}" />
        <meta property="og:image" content="https://pizzakraken.com/assets/og_image.png" />
        <meta property="og:type" content="website" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="{{ $page['props']['meta']['title'] }}" />
        <meta name="twitter:description" content="{{ $page['props']['meta']['description'] }}" />
        <meta name="twitter:image" content="https://pizzakraken.com/assets/og_image.png" />

        <title inertia>
        @if(isset($page['props']['meta']['title']))
            {{ $page['props']['meta']['title'] }}
        @else
            {{ config('app.name', 'Laravel') }}
        @endif
        </title>
   
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
