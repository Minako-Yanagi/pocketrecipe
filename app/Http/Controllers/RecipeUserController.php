<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Recipe;

class RecipeUserController extends Controller
{
    public function made()
    {
        $recipeCode = request()->recipeCode;

        // Search recipes from "recipeCode"
        $client = new \RakutenRws_Client();
        $client->setApplicationId(env('RAKUTEN_APPLICATION_ID'));
        $rws_response = $client->execute('IchibaRecipeSearch', [
            'recipeCode' => $recipeCode,
        ]);
        $rws_recipe = $rws_response->getData()['Recipes'][0]['Recipe'];

        // create Recipe, or get recipe if an recipe is found
        $recipe = Recipe::firstOrCreate([
            'code' => $rws_recipe['recipeCode'],
            'name' => $rws_recipe['recipeName'],
            'url' => $rws_recipe['recipeUrl'],
            // remove "?_ex=128x128" because its size is defined
            'image_url' => str_replace('?_ex=128x128', '', $rws_recipe['mediumImageUrls'][0]['imageUrl']),
        ]);

        \Auth::user()->made($recipe->id);

        return redirect()->back();
    }

    public function dont_made()
    {
        $recipeCode = request()->recipeCode;

        if (\Auth::user()->is_madeing($recipeCode)) {
            $recipeId = Recipe::where('code', $recipeCode)->first()->id;
            \Auth::user()->dont_made($recipeId);
        }
        return redirect()->back();
    }
}