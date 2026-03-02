<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'description',
        'image',
        'is_best'
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getMinPriceAttribute()
    {
        return $this->variants->min('price') ?? 0;
    }

    public function getMaxPriceAttribute()
    {
        return $this->variants->max('price') ?? 0;
    }

    public function getTotalStockAttribute()
    {
        return $this->variants->sum('stock');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
