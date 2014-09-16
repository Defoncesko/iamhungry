<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::group(array('prefix' => '/'), function() {


	Route::resource('authors', 'AuthorsController', 
		array('only' => array('index', 'show', 'store', 'update', 'destroy')));

	Route::get('recipes/{valuedep}/{valuefin}', 'RecipesController@select');
	Route::get('recipes/search/{txt}', 'RecipesController@search');
	Route::resource('recipes', 'RecipesController', 
		array('only' => array('index', 'show', 'store', 'update', 'destroy')));

	Route::resource('categories', 'CategoriesController', 
		array('only' => array('index', 'show', 'store', 'update', 'destroy')));

	Route::resource('categoriepreparations', 'CategoriesPreparationsController', 
		array('only' => array('index', 'show', 'store', 'update', 'destroy')));

	Route::resource('countries', 'CountriesController', 
		array('only' => array('index', 'show', 'store', 'update', 'destroy')));

	Route::resource('photos', 'PhotosController', 
		array('only' => array('index', 'show', 'store', 'update', 'destroy')));

	Route::resource('sentencespreparations', 'SentencesPreparationsController', 
		array('only' => array('index', 'show', 'store', 'update', 'destroy')));

	Route::resource('categorieingredients', 'CategoriesIngredientsController', 
		array('only' => array('index', 'show', 'store', 'update', 'destroy')));

	// Route::resource('quantiteingredients', 'QuantiteIngredientsController', 
	// 	array('only' => array('index', 'show', 'store', 'update', 'destroy')));

	Route::resource('ingredients', 'IngredientsController', 
		array('only' => array('index', 'show', 'store', 'update', 'destroy')));



	// Route::resource('categorierecettes', 'CategorieRecettesController', 
	// 	array('only' => array('index', 'show', 'store', 'update', 'destroy')));
	


});

