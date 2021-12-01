<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @include('shared.favicon')

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @laravelPWA
    </head>
    <body class="font-sans antialiased">
        @inertia
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </body>
</html>
