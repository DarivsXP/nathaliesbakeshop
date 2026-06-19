<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="/logo.ico" sizes="any">
        <link rel="shortcut icon" href="/logo.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="/logo.ico">

        <meta name="description" content="Handcrafted Filipino delicacies and custom celebration cakes from Nathalie's Bakeshop in Québec, Canada.">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ config('app.name', 'Nathalie\'s Bakeshop') }}">
        <meta property="og:title" content="{{ config('app.name', 'Nathalie\'s Bakeshop') }}">
        <meta property="og:description" content="Handcrafted Filipino delicacies and custom celebration cakes from Nathalie's Bakeshop in Québec, Canada.">
        <meta property="og:image" content="{{ url('/logo.ico') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{{ config('app.name', 'Nathalie\'s Bakeshop') }}">
        <meta name="twitter:description" content="Handcrafted Filipino delicacies and custom celebration cakes from Nathalie's Bakeshop in Québec, Canada.">
        <meta name="twitter:image" content="{{ url('/logo.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
