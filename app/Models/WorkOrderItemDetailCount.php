<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrderItemDetailCount extends Model
{
    use HasFactory;

    protected $table = 'work_order_item_detail_count';  // Nombre de la tabla
    protected $primaryKey = 'id';  // Clave primaria

    protected $fillable = [
        'work_order_item_detail_id',
        'price_category_id',
        'unit_id',
        'count',
    ];

}
