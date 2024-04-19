<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    public function store(Request $request)
    {
        try {
            User::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'correo' => $request->correo,
                'telefono' => $request->telefono,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
            ]);

            return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->withInput()->with('error', 'El correo electrónico ya está en uso. Por favor, intenta con otro.');
            } else {
                return back()->withInput()->with('error', 'Error al crear el usuario');
            }
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al crear el usuario. Por favor, intenta nuevamente.');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'Usuario no encontrado.');
        }
        $roles = Role::all();

        return view('users.edit',  ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'Usuario no encontrado.');
        }

        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->correo = $request->correo;
        $user->telefono = $request->telefono;
        $user->role_id = $request->role_id;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        try {
            $user->save();
            return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
        } catch (QueryException $e) {
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
        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'Usuario no encontrado.');
        }

        return view('users.delete', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'Usuario no encontrado.');
        }

        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }
}
