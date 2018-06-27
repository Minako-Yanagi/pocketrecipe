<?php

  namespace App\Http\Controllers;  
  
  use \App\Recipe;

  class RecipesController extends Controller
  {

    public function create()
    {
   $result = request()->result;
        $recipes = [];
    if ($result) {
            $client = new \RakutenRws_Client();
            $client->setApplicationId(env('RAKUTEN_APPLICATION_ID'));


            $rws_response = $client->execute('RecipeCategoryList', [
                'categoryType' => 'large',
            ]);
            
            // Creating "Recipe" instance to make it easy to handle.（not saving
             foreach ($rws_response->getData()['result']['large'] as $rws_recipe) {
                $recipe = new Recipe();
                $recipe->code = $rws_recipe['recipeCode'];
                $recipe->name = $rws_recipe['categoryName'];
                $recipe->url = $rws_recipe['recipeUrl'];
         //       $recipe->image_url = str_replace('?_ex=128x128', '', $rws_recipe['Recipe']['mediumImageUrls'][0]['imageUrl']);
                $recipes[] = $recipe;
                var_dump($recipe);
            }
        
    return view('recipes.create', [
            'result' => $result,
            'recipes' => $recipes,
        ]);
    }
    
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