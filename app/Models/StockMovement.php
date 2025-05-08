<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'raw_material_id',
        'change',
        'type',
        'note',
        'created_at',
    ];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
