<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    // Nama Table
    protected $table = "categories";

    // Kolom yang boleh diisi
    protected $fillable = ['category_name', 'slug'];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            $category->slug = Str::slug($category->category_name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relasi: Category memiliki banyak Product
    // Karena 1 Category memiliki banyak Product, maka nama method-nya dibuat jamak: products
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
