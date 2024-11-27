<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RolPermiso extends Pivot
{
    use HasFactory;

    protected $table = 'roles_permisos';
    public $incrementing = false;
    protected $fillable = ['id_rol', 'id_permiso'];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function permiso()
    {
        return $this->belongsTo(Permiso::class, 'id_permiso');
    }
}
