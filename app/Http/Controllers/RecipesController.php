<?php

  namespace App\Http\Controllers;  
  
  use \App\Recipe;

  class RecipesController extends Controller
  {

    public function create()
    {
        $result = request()->keyword;
        $recipes = [];
//        if (!$result) {
            $client = new \RakutenRws_Client();
            $client->setApplicationId(env('RAKUTEN_APPLICATION_ID'));

            $rws_response = $client->execute('RecipeCategoryList', [
                'categoryType' => 'large',
            ]);
            
            // Creating "Recipe" instance to make it easy to handle.（not saving
    
            foreach ($rws_response->getData()['result']['large'] as $k => $rws_recipe) {
                $recipe = new Recipe();
                $parentCategoryId = '';
                if($recipe->categoryType == 'small'){
                    $parentCategoryId = $rws_recipe['parentCategoryId'];
                }
                $recipe->categoryType = 'large';
                $recipe->categoryId = $rws_recipe['categoryId'];
                $recipe->categoryName = $rws_recipe['categoryName'];
                $recipe->categoryUrl = $rws_recipe['categoryUrl'];
                $recipe->parentCategoryId = $parentCategoryId;
                
                if($result == null || $result == '' || mb_strpos($recipe->categoryName,$result,0,'utf-8') !== false){
                    $recipes[] = $recipe;
                   //$recipe->image_url = str_replace('?_ex=128x128', '', $rws_recipe['Recipe']['mediumImageUrls'][0]['imageUrl']);
                }
                
            }
//        }

        return view('recipes.create', [
            'keyword' => $result,
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
