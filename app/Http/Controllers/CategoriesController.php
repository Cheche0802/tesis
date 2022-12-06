<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
    	return view('pages.home', [
    		'title' => "Publicaciones de la categoría '{$category->name}'",
    		'posts' => $category->posts()->published()->paginate()
		]);
    }
}
