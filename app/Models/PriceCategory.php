<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceCategory extends Model
{
    use HasFactory;
    protected $table = 'price_category';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

}

