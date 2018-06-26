<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\Recipe;

class UsersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $count_made = $user->made_recipes()->count();
        $recipes = \DB::table('recipes')->join('recipe_user', 'recipes.id', '=', 'recipe_user.recipe_id')->select('recipes.*')->where('recipe_user.user_id', $user->id)->distinct()->paginate(20);

        return view('users.show', [
            'user' => $user,
            'recipes' => $recipes,
            'count_made' => $count_made,
        ]);
    }
}