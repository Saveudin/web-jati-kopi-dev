<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    // Define the table associated with the model
    protected $table = 'recipes';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'product_id',
        'raw_material_id',
        'quantity',
        'unit',
        'created_at',
        'updated_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function rawMaterial()
{
    return $this->belongsTo(RawMaterial::class);
}
}
