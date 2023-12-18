<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //written all because there are only few categories, if there are many categories then we can use pagination
        $categories = Category::all();

        return CategoryResource::collection($categories);
    }
}
