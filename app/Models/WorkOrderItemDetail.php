<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrderItemDetail extends Model
{
    use HasFactory;

    protected $table = 'work_order_item_detail';  // Nombre de la tabla
    protected $primaryKey = 'id';  // Clave primaria

    protected $fillable = [
        'work_order_item_id',
        'amount',
    ];

}
