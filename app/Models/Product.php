<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    // Nama Table
    protected $table = "products";

    // Kolom yang boleh diisi
    protected $fillable = [
        'name',
        'slug',
        'price',
        'stock',
        'description',
        'image',
        'category_id'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relasi: Product milik satu Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
