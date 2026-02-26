<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'attribute_name', 'attribute_value', 'price', 'stock'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
