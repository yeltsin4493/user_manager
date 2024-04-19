<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl text-center text-gray-800 mb-6"><i class="fas fa-trash-alt mr-2"></i>Eliminar Usuario</h1>
        <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
            <p class="text-gray-700 text-lg mb-4">¿Estás seguro de que deseas eliminar este usuario {{ $user->nombre }}?
            </p>
            <p class="text-red-600 text-sm mb-8">Esta acción no se puede deshacer.</p>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-between">
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline">Eliminar</button>
                    <a href="{{ route('users.index') }}" class="text-gray-600 font-bold hover:underline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
