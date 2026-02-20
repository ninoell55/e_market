<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    // Nama Table
    protected $table = "products";

    // Kolom yang boleh diisi
    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'image',
        'category_id'
    ];

    // Boot method untuk mengisi slug secara otomatis saat membuat produk baru
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    // Gunakan slug sebagai route key
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relasi: Product milik satu Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relasi: Product memiliki banyak ProductVariant
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    // Shortcut untuk ambil total stok dari semua varian
    public function getTotalStockAttribute()
    {
        return $this->variants->sum('stock');
    }   
}
