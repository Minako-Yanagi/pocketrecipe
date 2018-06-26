<?php

  namespace App\Http\Controllers;  
  
  use \App\Recipe;

  class RecipesController extends Controller
  {

    public function create()
    {
        $keyword = request()->keyword;
        $recipes = [];
        if ($keyword) {
            $client = new \RakutenRws_Client();
            $client->setApplicationId(env('RAKUTEN_APPLICATION_ID'));

            $rws_response = $client->execute('IchibaRecipeSearch', [
                'keyword' => $keyword,
                'imageFlag' => 1,
                'hits' => 20,
            ]);

            // Creating "Recipe" instance to make it easy to handle.（not saving）
            foreach ($rws_response->getData()['Recipes'] as $rws_recipe) {
                $recipe = new Recipe();
                $recipe->code = $rws_recipe['Recipe']['recipeCode'];
                $recipe->name = $rws_recipe['Recipe']['recipeName'];
                $recipe->url = $rws_recipe['Recipe']['recipeUrl'];
                $recipe->image_url = str_replace('?_ex=128x128', '', $rws_recipe['Recipe']['mediumImageUrls'][0]['imageUrl']);
                $recipes[] = $recipe;
            }
        }

        return view('recipes.create', [
            'keyword' => $keyword,
            'recipes' => $recipes,
        ]);
    }
    
     public function show($id)
    {
      $recipe = Recipe::find($id);
      $made_users = $recipe->made_users;

      return view('recipes.show', [
          'recipe' => $recipe,
          'made_users' => $made_users,
      ]);
    }
    
    
  }