
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'LeadRhino') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

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
    <body class="font-sans antialiased">
        <!-- blade template to create a team if the user isn't assigned to one -->
<!-- resources\views\teams\create.blade.php -->

<!-- background -->
<div class="bg-gray-100 min-h-screen flex flex-col justify-center">
    <div class="container mx-auto">
        <div class="max-w-lg mx-auto bg-white p-4" style="border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
            <div class="mb-3">
                <h1 class="font-bold pb-1" style="font-size: 1.25rem; color: #28323b;">Create a team</h1>
                <p style="color: #28323b; font-size: 0.8125rem;">It looks like you don't currently have a team in your account. Let's get you set up with a new one! Create a unique name for your new team and click 'Create Team' to get started."</p>
            </div>
            <form action="{{ route('teams.store.block') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="block text-sm font-bold mb-2" style="font-size: 0.8125rem; color: #28323b;">Team name</label>
                    <input type="text" name="name" id="name" class="border border-black p-2 w-full" style="border-radius: 4px; height: 40px;" required>
                </div>
                <div>
                    <button type="submit" style="background-color: #f05628; font-size: 0.8125rem; font-weight: 700; text-decoration: none; text-transform: none !important; letter-spacing: 0; text-indent: 0;" class="text-white px-4 py-2 rounded font-bold w-full">Create team</button>
                </div>
            </form>
        </div>
    </div>
</div>

        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
