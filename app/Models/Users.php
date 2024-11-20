<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';  // Nombre de la tabla
    protected $primaryKey = 'id';  // Clave primaria

    protected $fillable = [
        'username',
        'is_active',
        'resource_id',
    ];

}
