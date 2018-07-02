<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Recipe;

class RankingController extends Controller
{
    public function made()
    {
        $recipes = \DB::table('recipe_user')->join('recipes', 'recipe_user.recipe_id', '=', 'recipes.id')->select('recipes.*', \DB::raw('COUNT(*) as count'))->where('type', 'made')->groupBy('recipes.id', 'recipes.categoryType', 'recipes.categoryId', 'recipes.categoryName', 'recipes.categoryUrl','recipes.parentCategoryId', 'recipes.created_at', 'recipes.updated_at')->orderBy('count', 'DESC')->take(10)->get();

        return view('ranking.made', [
            'recipes' => $recipes,
        ]);
    }
}