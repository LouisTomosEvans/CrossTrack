<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CrossTrack') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        <!-- change font -->
        <style>
            .font-sans {
                font-family: 'Inter', sans-serif;
            }
            .font-serif {
                font-family: 'Inter', serif;
            }
            .font-mono {
                font-family: 'Inter', monospace;
            }
        </style>
    </head>
    <body>
        <script>
            fbq('track', 'StartTrial');
        </script>
        <div class="font-sans text-white antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
