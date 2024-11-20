<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'task';
    protected $primaryKey = 'id';

    protected $fillable = [
        'work_order_item_detail_id',
        'task_status_id',
        'resource_id_assigned',
        'purchase_order_item_id',
        'woidc_price_cat_currency_id',
    ];

}
