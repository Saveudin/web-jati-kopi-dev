<?php

namespace App\Models;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    
    public function recipe() : HasMany
    {
        return $this->hasMany(Recipe::class, 'raw_material_id');
    }
}
