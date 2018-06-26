<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Recipe;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $recipes = Recipe::orderBy('updated_at', 'desc')->paginate(20);
        return view('welcome', [
            'recipes' => $recipes,
        ]);
    }
}