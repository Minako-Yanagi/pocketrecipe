<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index');

// User registration
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Login authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// Ranking
Route::get('ranking/made', 'RankingController@made')->name('ranking.made');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('recipes', 'RecipesController', ['only' => ['create', 'show']]);
    Route::post('made', 'RecipeUserController@made')->name('recipe_user.made');
    Route::delete('made', 'RecipeUserController@dont_made')->name('recipe_user.dont_made');
    Route::resource('users', 'UsersController', ['only' => ['show']]);
});