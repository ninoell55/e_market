<?php

namespace App\Http\Controllers;

use App\Models\Category;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['products' => function ($query) {
            $query->where('is_best', true)->take(4);
        }])->whereIn('slug', ['shoes', 'clothes', 'accessories'])->get();

        $shoes = $categories->where('slug', 'shoes')->first();
        $clothes = $categories->where('slug', 'clothes')->first();
        $accessories = $categories->where('slug', 'accessories')->first();

        return view('welcome', compact('shoes', 'clothes', 'accessories'));
    }
}
