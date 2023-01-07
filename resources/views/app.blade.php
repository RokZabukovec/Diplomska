<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title inertia>{{ config('app.name', 'Laravel') }} @if(!empty(config('app.slogan', '')))| {{ config('app.slogan', '') }} @endif</title>
    <meta name="title" content="CommandHub">
    <meta name="description" content="Our online platform makes it easy to save and search for the commands you use most, so you can save time and streamline your workflow.">
    <meta name="keywords" content="terminal, commands, cli">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="Rok Zabukovec">
    <!-- Scripts -->
    @routes
    @vite('resources/js/app.js')
    @inertiaHead
</head>
<body class="font-inter font-feature-default antialiased h-full overflow-scroll">
@inertia
</body>
</html>
