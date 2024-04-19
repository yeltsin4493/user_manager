<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['nombre', 'apellido', 'correo', 'telefono', 'password', 'role_id'];

    protected $hidden = ['password']; // Ocultar el campo password en las consultas JSON

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
