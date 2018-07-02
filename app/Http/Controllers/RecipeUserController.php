<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Recipe;

class RecipeUserController extends Controller
{
    public function made()
    {
        //$categoryType = request()->categoryType;

        // Search recipes from "recipeCode"
/*
        $client = new \RakutenRws_Client();
        $client->setApplicationId(env('RAKUTEN_APPLICATION_ID'));
        $rws_response = $client->execute('RecipeCategoryList', [
            'categoryType' => $categoryType,
        ]);
        $rws_recipe = $rws_response->getData()['result']['large']['0'];
exit;
*/
        // create Recipe, or get recipe if an recipe is found
        $parentCategoryId = request()->parentCategoryId;
        if($parentCategoryId == ''){$parentCategoryId = '00000';}
        $recipe = Recipe::firstOrCreate([
            'categoryId' => request()->categoryId,
            'categoryName' => request()->categoryName,
            'categoryUrl' => request()->categoryUrl,
            'categoryType' => request()->categoryType,
            'parentCategoryId' => $parentCategoryId,
            // remove "?_ex=128x128" because its size is defined
    //        'image_url' => str_replace('?_ex=128x128', '', $rws_recipe['mediumImageUrls'][0]['imageUrl']),
        ]);
        \Auth::user()->made($recipe->id,'code');

        return redirect()->back();
    }

    public function dont_made()
    {
        $categoryId = request()->categoryId;
        if (\Auth::user()->is_madeing($categoryId,'code')) {
            $id = Recipe::where('categoryId',$categoryId)->first()->id;
            \Auth::user()->dont_made($id);
        }
        return redirect()->back();
    }
}