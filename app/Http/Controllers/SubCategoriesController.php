<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //written all because there are only few sub-categories, if there are many sub-categories then we can use pagination
        $subCategories = SubCategory::all();

        return SubCategoryResource::collection($subCategories);
    }
}
