<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function index ()
  {
      return  CategoryResource::collection(Category::all());
  }

  public function store(Request $request)
  {
      $category =  Category::create([
            'name' => $request->name,
            'is_active' => $request->is_active
        ]);

        return response($category);

  }
}
