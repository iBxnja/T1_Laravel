<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    protected $table = 'task_status';  // Nombre de la tabla
    protected $primaryKey = 'id';  // Clave primaria

    protected $fillable = [
        'name',  // Nombre del estado de la tarea
    ];

   
}
