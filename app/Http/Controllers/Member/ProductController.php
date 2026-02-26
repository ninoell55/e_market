<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $shoes = Category::with(['products' => function ($query) {
            $query->where('is_active', true)->take(4);
        }])->where('slug', 'shoes')->first();
        
        $clothes = Category::with(['products' => function ($query) {
            $query->where('is_active', true)->take(4);
        }])->where('slug', 'clothes')->first();
        
        $accessories = Category::with(['products' => function ($query) {
            $query->where('is_active', true)->take(4);
        }])->where('slug', 'accessories')->first();

        return view('welcome', compact('shoes', 'clothes', 'accessories'));
    }
}
