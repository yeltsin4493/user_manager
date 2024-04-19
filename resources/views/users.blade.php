<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <header class="bg-blue-500 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div>
                <span>BIENVENIDO {{ strtoupper(auth()->user()->nombre) }} {{ strtoupper(auth()->user()->apellido) }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-white hover:underline">Salir</button>
            </form>
        </div>
    </header>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold mb-4">Tabla de Usuarios</h1>

        @if (auth()->user()->role_id === 1)
            <div class="mb-4">
                <a href="{{ route('users.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i
                        class="fas fa-plus mr-2"></i>Nuevo Usuario</a>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-200 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p class="font-bold">Éxito:</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-200 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Error:</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2 bg-gray-200 text-left">ID</th>
                        <th class="px-4 py-2 bg-gray-200 text-left">Nombre</th>
                        <th class="px-4 py-2 bg-gray-200 text-left">Apellido</th>
                        <th class="px-4 py-2 bg-gray-200 text-left">Correo</th>
                        <th class="px-4 py-2 bg-gray-200 text-left">Rol</th>
                        <th class="px-4 py-2 bg-gray-200 text-left">Nro de Teléfono</th>
                        @if (auth()->user()->role_id === 1)
                            <th class="px-4 py-2 bg-gray-200 text-left">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-2">{{ $user->id }}</td>
                            <td class="px-4 py-2">{{ $user->nombre }}</td>
                            <td class="px-4 py-2">{{ $user->apellido }}</td>
                            <td class="px-4 py-2">{{ $user->correo }}</td>
                            <td class="px-4 py-2">{{ $user->role->nombre }}</td>
                            <td class="px-4 py-2">{{ $user->telefono }}</td>
                            @if (auth()->user()->role_id === 1)
                                <td class="px-4 py-2">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="text-blue-600 hover:underline mr-2"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('users.delete', $user->id) }}"
                                        class="text-red-600 hover:underline mr-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
