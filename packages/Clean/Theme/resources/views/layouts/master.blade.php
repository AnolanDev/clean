<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clean</title>
    @vite(['packages/Clean/Theme/resources/assets/css/app.css'])
</head>
<body class="bg-gray-100 text-gray-900">

    <div class="min-h-screen">
        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <h1 class="text-2xl font-bold text-blue-600">Clean</h1>
                    <p class="text-sm text-gray-600">Tu tienda de productos de limpieza</p>
                </div>
            </div>
        </header>
        
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>

</body>
</html>
