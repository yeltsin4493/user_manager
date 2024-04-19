<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white p-8 rounded-md shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Iniciar Sesión</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" class="form-input w-full rounded-md shadow-sm"
                    placeholder="Correo Electrónico" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-input w-full rounded-md shadow-sm"
                    placeholder="Contraseña" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline">Iniciar
                    Sesión</button>
                <a href="#" class="text-gray-600 hover:underline">¿Olvidaste tu contraseña?</a>
            </div>
        </form>
    </div>
</body>

</html>
