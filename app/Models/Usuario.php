<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [ 'id_rol', 'nombre_usuario', 'apellido_usuario', 'email_usuario', 'password_usuario', 'fecha_registro', 'estado_usuario', ];

    protected $hidden = [ 'password_usuario', 'remember_token'];

    public function role()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function carritos()
    {
        return $this->hasMany(Carrito::class, 'id_usuario');
    }

    public function getAuthIdentifierName()
    {
        return 'email_usuario';
    }

    public function getAuthPassword()
    {
        return $this->password_usuario;
    }
}
