<html>
    <head>
        <title>Brew CRUD Project</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="flex items-center justify-center min-h-screen bg-gray-100 p-4">
            {{ $slot }}
        </div>
    </body>
</html>
