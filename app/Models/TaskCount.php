<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCount extends Model
{
    use HasFactory;

    protected $table = 'task_count';  // Nombre de la tabla
    protected $primaryKey = 'id';  // Clave primaria

    protected $fillable = [
        'task_id',
        'unit_price',
        'work_order_item_detail_count',
        'count',
        'amount',
    ];

}
