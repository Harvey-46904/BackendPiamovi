<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;
    protected $fillable = ['nombres_completos','correo','telefono','pin','fecha_nacimiento','genero','acuerdos'];
}
