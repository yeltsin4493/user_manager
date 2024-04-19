<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl text-center text-gray-800 mb-6"><i class="fas fa-user-plus mr-2"></i>Crear Nuevo Usuario</h1>

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error:</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        
        <form action="{{ route('users.store') }}" method="POST"
            class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-input w-full rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="apellido" class="block text-gray-700 font-bold mb-2">Apellido:</label>
                <input type="text" id="apellido" name="apellido" class="form-input w-full rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="correo" class="block text-gray-700 font-bold mb-2">Correo:</label>
                <input type="email" id="correo" name="correo" class="form-input w-full rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="telefono" class="block text-gray-700 font-bold mb-2">Nro de Teléfono:</label>
                <input type="text" id="telefono" name="telefono" class="form-input w-full rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="role_id" class="block text-gray-700 font-bold mb-2">Rol:</label>
                <select id="role_id" name="role_id" class="form-select w-full rounded-md shadow-sm">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="contraseña" class="block text-gray-700 font-bold mb-2">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-input w-full rounded-md shadow-sm">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline">Guardar</button>
                <a href="{{ route('users.index') }}" class="text-gray-600 font-bold hover:underline">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>
