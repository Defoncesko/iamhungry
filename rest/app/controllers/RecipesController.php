<?php

class RecipesController extends \BaseController {

	/**
	 * Display a listing of the researched recipes.
	 * GET /recipes/{valuedep}/{valuefin}
	 *
	 * @return Response
	 */
	public function select($valuedep,$valuefin)
	{
		echo $valuedep." - ".$valuefin;
		// On set les connexions
		$recipeObj = new Recipe;
		$recipeObj->getConnection()->setFetchMode(PDO::FETCH_ASSOC);
		$recipeObj->getConnection()->getPdo()->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY ,false);

		$recipes = $recipeObj->skip($valuedep)->take($valuefin - $valuedep)->get();

		$cptRecipe = 0;
		foreach ($recipes as $recipe) {
			
			$recipe->toArray();
			$id = $recipe['id'];
			$authors = Recipe::find($id)->authors()->lists('name'); // On récupère les auteurs
			$photos = Recipe::find($id)->photos()->lists('name'); // On récupère les photos
			$categories = Recipe::find($id)->categories()->lists('name'); // On récupère les categories

			$recipe['authors'] = $authors;
			$recipe['photos'] = $photos;
			$recipe['categories'] = $categories;

			// On récupère les categories pour les préparation
			$categoriespreparation = Recipe::find($id)->categoriespreparation()->lists('name','id'); 

			// On stocke les id de chaque categories
			$varkeysCatePrepa = array_keys($categoriespreparation);


			$cptCatPrepa = 0;
			foreach ($varkeysCatePrepa as $key) {

				// on ajoute le titre et la liste des ingredients avec l'ordre et l'ingredient
				$recipe['categoriespreparation'][$cptCatPrepa]['Title'] = $categoriespreparation[$key];
				$recipe['categoriespreparation'][$cptCatPrepa]['List'] = CategoriesPreparation::find($key)->sentencespreparation()->lists('name','order');
				unset($recipe['categoriespreparation'][$cptCatPrepa]['name']);
				unset($recipe['categoriespreparation'][$cptCatPrepa]['id']);
				unset($recipe['categoriespreparation']['id']);
				unset($recipe['categoriespreparation']['name']);

				$cptCatPrepa++;

			}
			

			// On récupère les ingredients pour les listes d'ingredients	
			$categoriesingredients = Recipe::find($id)->categoriesingredients()->lists('name','id'); 

			// On stocke les id de chaque categories
			$varkeysCateIngre = array_keys($categoriesingredients);


			$cptCatIngre = 0;
			foreach ($varkeysCateIngre as $key) {

				// on ajoute le titre et la liste des ingredients avec l'ordre et l'ingredient
				$recipe['categoriesingredients'][$cptCatIngre]['Title'] = $categoriesingredients[$key];
				$ar1 = CategoriesIngredient::find($key)->ingredients()->lists('name','order');
				$ar2 = CategoriesIngredient::find($key)->quantities()->lists('name','order');

				$result = array();

				foreach ($ar1 as $key => $value) {
					if (array_key_exists($key,$result))
					    $result[$key] =  $value ." ".$result[$key];
					else
					    $result[$key] = $value;
				}
				foreach ($ar2 as $key => $value) {
					    if (array_key_exists($key,$result))
					        $result[$key] = $value ." ".$result[$key];
					    else
					        $result[$key] = $value;
				}

				$recipe['categoriesingredients'][$cptCatIngre]['List'] = $result;
				unset($recipe['categoriesingredients'][$cptCatIngre]['id']);
				unset($recipe['categoriesingredients'][$cptCatIngre]['name']);
				$cptCatIngre++;

			}
			unset($recipe['pivot']);
			
			foreach($recipe['categoriespreparation']->toArray() as $elementKey => $element) {
			    foreach($element as $valueKey => $value) {
			        if($valueKey == 'id'){
			            unset($recipe['categoriespreparation'][$elementKey]);
			        } 
			    }
			}
			foreach($recipe['categoriesingredients']->toArray() as $elementKey => $element) {
			    foreach($element as $valueKey => $value) {
			        if($valueKey == 'id'){
			            unset($recipe['categoriesingredients'][$elementKey]);
			        } 
			    }
			}
			

			$recipes[$cptRecipe] = $recipe;

			$cptRecipe++;
		}

		return Response::json($recipes);
	}
	
	/**
	 * Display a listing of the researched recipes.
	 * GET /recipes/search/{txt}
	 *
	 * @return Response
	 */
	public function search($txt)
	{
		// On set les connexions
		$recipeObj = new Recipe;
		$recipeObj->getConnection()->setFetchMode(PDO::FETCH_ASSOC);
		$recipeObj->getConnection()->getPdo()->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY ,false);


		//On récupère la recette brut
		$recipes = $recipeObj::
			where('title', 'LIKE', '%'.$txt.'%')
			->orWhere('advice', 'LIKE', '%'.$txt.'%')
			->orWhere('id', '=', function($query) use ($txt)
            {
                $query->select('recipe_id')
                      ->from('catingre_qutyingre_ingr_recipe')
                      ->where('id', '=', function($query2) use ($txt)
			            {
			                $query2->select('ingredient_id')
			                      ->from('ingredients')
			                      ->where('name', 'LIKE', '%'.$txt.'%');
			            });
            })
			->get();

			// $queries = DB::getQueryLog();
			// $last_query = end($queries);
			// var_dump($last_query);
			//select * from `recipes` 
			//where `title` LIKE %lait% or `advice` LIKE %lait% or `id` = (select `recipe_id` from `catingre_qutyingre_ingr_recipe` where `id` = (select `id` from `ingredients` where `name` LIKE %lait%))

			// SELECT * FROM recipes
			// WHERE title LIKE '%lyon%'
			// OR advice LIKE '%lyon%'
			// OR id = (
			// 	SELECT recipe_id FROM catingre_qutyingre_ingr_recipe
			//         WHERE ingredient_id = (
			//         	SELECT id FROM ingredients
			//                 WHERE name LIKE '%lyon%'
			//         )
			// )

		//var_dump($recipes);

		$cptRecipe = 0;
		foreach ($recipes as $recipe) {
			
			$recipe->toArray();
			$id = $recipe['id'];
			$authors = Recipe::find($id)->authors()->lists('name'); // On récupère les auteurs
			$photos = Recipe::find($id)->photos()->lists('name'); // On récupère les photos
			$categories = Recipe::find($id)->categories()->lists('name'); // On récupère les categories

			$recipe['authors'] = $authors;
			$recipe['photos'] = $photos;
			$recipe['categories'] = $categories;

			// On récupère les categories pour les préparation
			$categoriespreparation = Recipe::find($id)->categoriespreparation()->lists('name','id'); 

			// On stocke les id de chaque categories
			$varkeysCatePrepa = array_keys($categoriespreparation);


			$cptCatPrepa = 0;
			foreach ($varkeysCatePrepa as $key) {

				// on ajoute le titre et la liste des ingredients avec l'ordre et l'ingredient
				$recipe['categoriespreparation'][$cptCatPrepa]['Title'] = $categoriespreparation[$key];
				$recipe['categoriespreparation'][$cptCatPrepa]['List'] = CategoriesPreparation::find($key)->sentencespreparation()->lists('name','order');
				unset($recipe['categoriespreparation'][$cptCatPrepa]['name']);
				unset($recipe['categoriespreparation'][$cptCatPrepa]['id']);
				unset($recipe['categoriespreparation']['id']);
				unset($recipe['categoriespreparation']['name']);

				$cptCatPrepa++;

			}
			

			// On récupère les ingredients pour les listes d'ingredients	
			$categoriesingredients = Recipe::find($id)->categoriesingredients()->lists('name','id'); 

			// On stocke les id de chaque categories
			$varkeysCateIngre = array_keys($categoriesingredients);


			$cptCatIngre = 0;
			foreach ($varkeysCateIngre as $key) {

				// on ajoute le titre et la liste des ingredients avec l'ordre et l'ingredient
				$recipe['categoriesingredients'][$cptCatIngre]['Title'] = $categoriesingredients[$key];
				$ar1 = CategoriesIngredient::find($key)->ingredients()->lists('name','order');
				$ar2 = CategoriesIngredient::find($key)->quantities()->lists('name','order');

				$result = array();

				foreach ($ar1 as $key => $value) {
					if (array_key_exists($key,$result))
					    $result[$key] =  $value ." ".$result[$key];
					else
					    $result[$key] = $value;
				}
				foreach ($ar2 as $key => $value) {
					    if (array_key_exists($key,$result))
					        $result[$key] = $value ." ".$result[$key];
					    else
					        $result[$key] = $value;
				}

				$recipe['categoriesingredients'][$cptCatIngre]['List'] = $result;
				unset($recipe['categoriesingredients'][$cptCatIngre]['id']);
				unset($recipe['categoriesingredients'][$cptCatIngre]['name']);
				$cptCatIngre++;

			}
			unset($recipe['pivot']);
			
			foreach($recipe['categoriespreparation']->toArray() as $elementKey => $element) {
			    foreach($element as $valueKey => $value) {
			        if($valueKey == 'id'){
			            unset($recipe['categoriespreparation'][$elementKey]);
			        } 
			    }
			}
			foreach($recipe['categoriesingredients']->toArray() as $elementKey => $element) {
			    foreach($element as $valueKey => $value) {
			        if($valueKey == 'id'){
			            unset($recipe['categoriesingredients'][$elementKey]);
			        } 
			    }
			}
			

			$recipes[$cptRecipe] = $recipe;

			$cptRecipe++;
		}

		return Response::json($recipes);
	}

	/**
	 * Display a listing of the resource.
	 * GET /recipes
	 *
	 * @return Response
	 */
	public function index()
	{
		// WORKING

		//$var = Recipe::find(1)->authors()->lists('name');
		//$var = Recipe::find(1)->photos()->lists('name');
		//$var = Recipe::find(1)->categories()->lists('name');
		//$var = Country::find(1)->recipes()->lists('title');
		//

		// ----  Pour les phrases de catégories -----
		// $var = Recipe::find(1)->categoriespreparation()->lists('name','id');
		// //$var = CategoriesPreparation::find(1)->sentencesprepatation()->lists('id');
		
		// $varkeys = array_keys($var);
		
		// $var2 = CategoriesPreparation::find($varkeys[1])->sentencespreparation()->lists('name');
		
		// BROKEN
		$var = Recipe::find(1)->countries();
		
		

		return Response::json($var);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /recipes
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /recipes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// On récupère la recette brut
		$recipe = Recipe::find($id)->toArray();
		$authors = Recipe::find($id)->authors()->lists('name'); // On récupère les auteurs
		$photos = Recipe::find($id)->photos()->lists('name'); // On récupère les photos
		$categories = Recipe::find($id)->categories()->lists('name'); // On récupère les categories

		$recipe['authors'] = $authors;
		$recipe['photos'] = $photos;
		$recipe['categories'] = $categories;

		// On récupère les categories pour les préparation
		$categoriespreparation = Recipe::find($id)->categoriespreparation()->lists('name','id'); 

		// On stocke les id de chaque categories
		$varkeysCatePrepa = array_keys($categoriespreparation);

		$cptCatPrepa = 0;
		foreach ($varkeysCatePrepa as $key) {

			// on ajoute le titre et la liste des ingredients avec l'ordre et l'ingredient
			$recipe['categoriespreparation'][$cptCatPrepa]['Title'] = $categoriespreparation[$key];
			$recipe['categoriespreparation'][$cptCatPrepa]['List'] = CategoriesPreparation::find($key)->sentencespreparation()->lists('name','order');

			$cptCatPrepa++;

		}

		// On récupère les ingredients pour les listes d'ingredients	
		$categoriesingredients = Recipe::find($id)->categoriesingredients()->lists('name','id'); 

		// On stocke les id de chaque categories
		$varkeysCateIngre = array_keys($categoriesingredients);

		$cptCatIngre = 0;
		foreach ($varkeysCateIngre as $key) {

			// on ajoute le titre et la liste des ingredients avec l'ordre et l'ingredient
			$recipe['categoriesingredients'][$cptCatIngre]['Title'] = $categoriesingredients[$key];
			$ar1 = CategoriesIngredient::find($key)->ingredients()->lists('name','order');
			$ar2 = CategoriesIngredient::find($key)->quantities()->lists('name','order');

			$result = array();

			foreach ($ar1 as $key => $value) {
				if (array_key_exists($key,$result))
				    $result[$key] =  $value ." ".$result[$key];
				else
				    $result[$key] = $value;
			}
			foreach ($ar2 as $key => $value) {
				    if (array_key_exists($key,$result))
				        $result[$key] = $value ." ".$result[$key];
				    else
				        $result[$key] = $value;
			}

			$recipe['categoriesingredients'][$cptCatIngre]['List'] = $result;
			$cptCatIngre++;

		}

		

		return Response::json($recipe);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /recipes/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /recipes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /recipes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}