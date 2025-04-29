<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    protected $fillable = [
        'name',
        'price',
        'stock',
        'unit',
        'created_at',
        'updated_at'
    ];
}
