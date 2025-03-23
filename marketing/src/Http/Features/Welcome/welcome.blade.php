<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    {{
        App\Assets\Facades\Bundle::serve('marketing', [
            'resources/css/app.css',
            'resources/js/app.tsx',
        ])
    }}
</head>
<body class="bg-white dark:bg-gray-950 text-gray-700 dark:text-gray-300 flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
<header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
    <nav class="flex items-center justify-end gap-4">
        @auth
            <x-marketing::button href="{{ url('/cp') }}" variant="outline">
                Dashboard
            </x-marketing::button>
        @else
            <x-marketing::button href="{{ url('/cp/login') }}">
                Log in
            </x-marketing::button>

            <x-marketing::button href="{{ url('/cp/register') }}" variant="outline">
                Register
            </x-marketing::button>
        @endauth
    </nav>
</header>
<div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
    <main class="px-6 py-24 sm:py-32 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-5xl font-semibold tracking-tight text-gray-900 dark:text-white">Welcome</h2>
            <p class="mt-8 text-gray-400 dark:text-gray-600 text-pretty text-lg">
                Pellentesque malesuada mi consequat, bibendum neque eu, dignissim tellus. In ut sapien id odio bibendum
                fermentum. Quisque sollicitudin, massa eu lobortis gravida, justo quam molestie libero, eget tempor
                nulla orci ac arcu. Morbi mauris diam, interdum non posuere aliquam, volutpat sit amet felis.
            </p>
        </div>
    </main>
</div>

</body>
</html>
