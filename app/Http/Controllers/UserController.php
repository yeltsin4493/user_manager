<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Importa la clase Hash
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('users', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', ['roles' => $roles]);
    }

    // public function create()
    // {
    //     return view('users.create');
    // }

    public function store(Request $request)
    {
        // Intenta crear un nuevo usuario en la base de datos
        try {
            // Crea un nuevo usuario en la base de datos
            User::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'correo' => $request->correo,
                'telefono' => $request->telefono,
                'password' => Hash::make($request->password), // Hashea la contraseña antes de almacenarla
                'role_id' => $request->role_id, // Agrega el ID del rol
            ]);

            // Redirige al usuario a la página de usuarios después de crear exitosamente
            return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
        } catch (QueryException $e) {
            // Si ocurre un error al crear el usuario debido a una excepción de consulta (por ejemplo, violación de restricción de clave única), muestra un mensaje de error específico
            if ($e->errorInfo[1] == 1062) {
                return back()->withInput()->with('error', 'El correo electrónico ya está en uso. Por favor, intenta con otro.');
            } else {
                return back()->withInput()->with('error', 'Error al crear el usuario');
            }
        } catch (\Exception $e) {
            // Si ocurre otro tipo de error, muestra un mensaje de error general
            return back()->withInput()->with('error', 'Error al crear el usuario. Por favor, intenta nuevamente.');
        }
    }

    public function edit($id)
    {
        // Busca al usuario por su ID
        $user = User::find($id);

        // Si no se encuentra el usuario, redirige con un mensaje de error
        if (!$user) {
            return back()->with('error', 'Usuario no encontrado.');
        }
        // Obtener todos los roles disponibles
        $roles = Role::all();

        // Renderiza la vista del formulario de edición con los datos del usuario
        return view('users.edit',  ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, $id)
    {
        // Busca al usuario por su ID
        $user = User::find($id);

        // Si no se encuentra el usuario, redirige con un mensaje de error
        if (!$user) {
            return back()->with('error', 'Usuario no encontrado.');
        }

        // Actualiza los datos del usuario
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->correo = $request->correo;
        $user->telefono = $request->telefono;
        $user->role_id = $request->role_id;

        // Si se proporcionó una nueva contraseña, hashea y actualiza la contraseña
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        // Intenta guardar los cambios en la base de datos
        try {
            $user->save();
            return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
        } catch (QueryException $e) {
            // Si ocurre un error al crear el usuario debido a una excepción de consulta (por ejemplo, violación de restricción de clave única), muestra un mensaje de error específico
            if ($e->errorInfo[1] == 1062) {
                return back()->withInput()->with('error', 'El correo electrónico ya está en uso. Por favor, intenta con otro.');
            } else {
                return back()->withInput()->with('error', 'Error al actualizar el usuario');
            }
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        // Busca al usuario por su ID
        $user = User::find($id);

        // Si no se encuentra el usuario, redirige con un mensaje de error
        if (!$user) {
            return back()->with('error', 'Usuario no encontrado.');
        }

        // Carga la vista de confirmación de eliminación y pasa el usuario como variable
        return view('users.delete', compact('user'));
    }

    public function destroy($id)
    {
        // Busca al usuario por su ID
        $user = User::find($id);

        // Si no se encuentra el usuario, redirige con un mensaje de error
        if (!$user) {
            return back()->with('error', 'Usuario no encontrado.');
        }

        // Intenta eliminar el usuario de la base de datos
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }
}
