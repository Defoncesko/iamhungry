<?php

class RecettesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /recettes
	 *
	 * @return Response
	 */
	public function index() {

		$recettes = DB::table('recettes')->get();

		//var_dump($recettes);
		
		$linkauthors = DB::table('link_recette_author')->get();
		$linkcategories = DB::table('link_recette_categorie')->get();
		$linkingreds = DB::table('link_recette_ingred')->get();
		$linkphotos = DB::table('link_recette_photo')->get();
		$linkpreparations = DB::table('link_recette_preparation')->get();

		$countries = DB::table('countries')->get();

		$authors = DB::table('autheurs')->get();
		$categories = DB::table('categories')->get();
		$photos = DB::table('photos')->get();
		$ingredients = DB::table('ingredients')->get();
		$quantiteIngredients = DB::table('quantiteIngredients')->get();
		$categorieIngredients = DB::table('categorieIngredients')->get();
		$phrasePrepas = DB::table('phrasePrepas')->get();
		$categoriePrepas = DB::table('categoriePrepas')->get();
		

		$recettesCopy = $recettes;
		
		$i = 0;
		$k = 0;
		foreach ( $recettesCopy as $currentrecette ) {

			// On ajoute le pays pour chaque recette.
			$recettes[$i]['country'] = array();
			foreach ($countries as $country) {
				if (strcmp($country['id'], $currentrecette['idPays']) == 0) {
					$recettes[$i]['country'] = $country['nom'];
				}
			}

			// On ajoute les auteurs pour chaque recette.
		 	$recettes[$i]['authors'] = array();
		 	
			foreach ($linkauthors as $currentlinkauthor) {
				
				if (strcmp($currentrecette['id'],$currentlinkauthor['idRecette']) == 0) {
					
					foreach ( $authors as $author ) {
		    			
						if (strcmp($author['id'],$currentlinkauthor['idAutheur']) == 0) {
							
							$recettes[$i]['authors'][$k] = $author['nom'];
							$k++;
						}
				    
					}

				}

			}

			// On ajoute les catégories pour chaque recette.
			$recettes[$i]['categories'] = array();
			$k = 0;
			foreach ($linkcategories as $currentlinkcategorie) {
				
				if (strcmp($currentrecette['id'],$currentlinkcategorie['idRecette']) == 0) {
					
					foreach ( $categories as $categorie ) {
		    			
						if (strcmp($categorie['id'],$currentlinkcategorie['idCategorie']) == 0) {
							
							$recettes[$i]['categories'][$k] = $categorie['nom'];
							$k++;
						}
				    
					}

				}

			}

			// On ajoute les photos pour chaque recette.
			$recettes[$i]['photos'] = array();
			$k = 0;
			foreach ($linkphotos as $currentlinkphoto) {
				
				if (strcmp($currentrecette['id'],$currentlinkphoto['idRecette']) == 0) {
					
					foreach ( $photos as $photo ) {
		    			
						if (strcmp($photo['id'],$currentlinkphoto['idPhoto']) == 0) {
							
							$recettes[$i]['photos'][$k] = $photo['nom'];
							$k++;
						}
				    
					}

				}

			}


			// On ajoute la liste de chaque categorie d'ingredients pour chaque recette.
			$recettes[$i]['ingredients'] = array();
			$k = 0;
			foreach ($linkingreds as $currentlinkingred) {

				if (strcmp($currentrecette['id'],$currentlinkingred['idRecette']) == 0) {

					$vartempingre = "";

					foreach ($categorieIngredients as $categorieIngredient) {

						if (strcmp($categorieIngredient['id'],$currentlinkingred['idCategorie']) == 0) {
							
							//echo "categorie : ".$categorieIngredient['nom']."  <br />";

							foreach ( $ingredients as $ingredient ) {

								//echo $ingredient['nom']." - ".$ingredient['id']." - ".$currentlinkingred['idIngredient']."<br />";
				    			
								if (strcmp($ingredient['id'],$currentlinkingred['idIngredient']) == 0) {
									
									$vartempingre = $ingredient['nom'];
									
								}

							}

							foreach ( $quantiteIngredients as $quantiteIngredient ) {
				    			
								if (strcmp($quantiteIngredient['id'],$currentlinkingred['idQuantite']) == 0) {
									
									if (empty($recettes[$i]['ingredients'][$categorieIngredient['nom']])) {
										$recettes[$i]['ingredients'][$categorieIngredient['nom']] = array();
									}

									$recettes[$i]['ingredients'][$categorieIngredient['nom']][$currentlinkingred['Ordre']] = $quantiteIngredient['nom']." ".$vartempingre;
								}
								
							}
							
						}
						
					}

				}

			}

			// On ajoute la liste de chaque categorie de préparations pour chaque recette.

			$recettes[$i]['preparation'] = array();
			$k = 0;
			foreach ($linkpreparations as $currentlinkpreparations) {

				if (strcmp($currentrecette['id'],$currentlinkpreparations['idRecette']) == 0) {

					$vartempingre = "";

					foreach ($categoriePrepas as $categoriePrepa) {

						if (strcmp($categoriePrepa['id'],$currentlinkpreparations['idCatPrepa']) == 0) {
							
							//echo "categorie : ".$categorieIngredient['nom']."  <br />";

							foreach ( $phrasePrepas as $phrasePrepa ) {

								//echo $ingredient['nom']." - ".$ingredient['id']." - ".$currentlinkingred['idIngredient']."<br />";
				    			
								if (strcmp($phrasePrepa['id'],$currentlinkpreparations['idPhrasePrepa']) == 0) {
									
									if (empty($recettes[$i]['preparation'][$categoriePrepa['nom']])) {
										$recettes[$i]['preparation'][$categoriePrepa['nom']] = array();
									}

									$recettes[$i]['preparation'][$categoriePrepa['nom']][$currentlinkpreparations['Ordre']] = $phrasePrepa['phrase'];
								
									
								}

							}
							
						}
						
					}

				}

			}


			$i++;
		}

		return Response::json($recettes);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /recettes/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /recettes
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /recettes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /recettes/{id}/edit
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
	 * PUT /recettes/{id}
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
	 * DELETE /recettes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}