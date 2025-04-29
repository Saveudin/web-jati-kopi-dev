<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\RawMaterial;

class Product extends Model
{
    // The $with property specifies the relationships to always eager load.
    // protected $with = ['category', 'rawMaterials'];

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'stock',
    ];

    public function rawMaterials()
    {
        return $this->belongsToMany(RawMaterial::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

