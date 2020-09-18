<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'AuthController@register')->name('register');
Route::post('/login', 'AuthController@login')->name('login');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'AuthController@logout');
    Route::get('/get-user', 'AuthController@getUser');
    Route::get('/check-recipe/{recipe}', 'RecipesController@checkUserRecipe');
    Route::get('/my-recipes', 'RecipesController@getUserRecipes')->name('user-recipes'); //Страница рецептов пользователя
});

Route::get('/', 'HomeController@index')->name('index'); //Главная страница
Route::get('/slider','HomeController@getSlider')->name('slider');//получение адреса для slider
Route::group(
    [
        'prefix' => 'recipes',
        'as' => 'recipes.'
    ], function () {

    Route::get('/', 'RecipesController@index')->name('index'); //Страница каталога рецептов
    Route::get('/{recipe}', 'RecipesController@show')->name('show'); //Страница одного рецепта
    Route::delete('/delete/{recipe}', 'RecipesController@destroy')->name('destroy')->middleware('auth:api'); //Удаление рецепта
    Route::post('/update/{recipe}', 'RecipesController@update')->name('update')->middleware('auth:api'); //Редактирование рецепта
    Route::post('/store', 'RecipesController@store')->name('store')->middleware('auth:api');//Добавление рецепта
});


Route::post('/product/store', 'ProductsController@store')->name('store')->middleware('auth:api');//Добавление продукта

Route::post('/product/search/', 'ProductsController@searchProduct')->name('search')->middleware('auth:api');
Route::resource('steps', 'StepsController')->except([
    'create', 'edit']);


Route::post('/upload', 'FileUploadController@uploadFile')->name('upload')->middleware('auth:api');
