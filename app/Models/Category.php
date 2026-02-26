<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
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

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
