<?php

  namespace App\Http\Controllers;  
  
  use \App\Recipe;

  class RecipesController extends Controller
  {

    public function create()
    {
        //ユーザー指定のパラメータをリクエストから取得する
        $result = request()->keyword;
        $categoryType = request()->categoryType;
        $categoryId = request()->categoryId;
        $recipes = [];
        
//        if (!$result) {
            $client = new \RakutenRws_Client();
            $client->setApplicationId(env('RAKUTEN_APPLICATION_ID'));
            
            //カテゴリタイプを設定する
            if($categoryType == null){
                $categoryType = 'large';
            }elseif($categoryType == 'large'){
                $categoryType = 'medium';
            }elseif($categoryType == 'medium'){
                $categoryType = 'small';
            }
            
            //カテゴリタイプごとにデータを取得する
            $rws_response = $client->execute('RecipeCategoryList', [
                'categoryType' => $categoryType,
            ]);
            
            //指定したカテゴリの下の階層のカテゴリを取得する
            // Creating "Recipe" instance to make it easy to handle.（not saving
            foreach ($rws_response->getData()['result'][$categoryType] as $k => $rws_recipe) {
                $recipe = new Recipe();
                $parentCategoryId = '';
                if($recipe->categoryType == 'small' || $recipe->categoryType == 'medium'){
                    $parentCategoryId = $rws_recipe['parentCategoryId'];
                    
                }
                if($parentCategoryId  == '' || $parentCategoryId == $categoryId){
                    $recipe->categoryType = $categoryType;
                    $recipe->categoryId = $rws_recipe['categoryId'];
                    $recipe->categoryName = $rws_recipe['categoryName'];
                    $recipe->categoryUrl = $rws_recipe['categoryUrl'];
                    $recipe->parentCategoryId = $parentCategoryId;
                    
                    if($result == null || $result == '' || mb_strpos($recipe->categoryName,$result,0,'utf-8') !== false){
                        $recipes[] = $recipe;
                       //$recipe->image_url = str_replace('?_ex=128x128', '', $rws_recipe['Recipe']['mediumImageUrls'][0]['imageUrl']);
                    }
                }
                
            }
    

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
