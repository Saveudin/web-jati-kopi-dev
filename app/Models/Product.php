<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Recipe;
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

    public function rawMaterial()
    {
        return $this->belongsToMany(RawMaterial::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}

