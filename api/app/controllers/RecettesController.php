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
			$countries = Country::where('id', '=', $currentrecette['idPays'])->firstOrFail();
			$recettes[$i]['country'] = $countries->nom;

			// On ajoute les auteurs pour chaque recette.
		 	$recettes[$i]['authors'] = array();

			foreach ($linkauthors as $currentlinkauthor) {
				
				if (strcmp($currentrecette['id'],$currentlinkauthor['idRecette']) == 0) {
					
					foreach ( $authors as $author ) {
		    			
						if (strcmp($author['id'],$currentlinkauthor['idAutheur']) == 0) {
							
							array_push($recettes[$i]['authors'], $author['nom']);
						}
				    
					}

				}

			}

			// On ajoute les catégories pour chaque recette.
			$recettes[$i]['categories'] = array();

			foreach ($linkcategories as $currentlinkcategorie) {
				
				if (strcmp($currentrecette['id'],$currentlinkcategorie['idRecette']) == 0) {
					
					foreach ( $categories as $categorie ) {
		    			
						if (strcmp($categorie['id'],$currentlinkcategorie['idCategorie']) == 0) {
							
							array_push($recettes[$i]['categories'], $categorie['nom']);
						}
				    
					}

				}

			}

			// On ajoute les photos pour chaque recette.
			$recettes[$i]['photos'] = array();

			foreach ($linkphotos as $currentlinkphoto) {
				
				if (strcmp($currentrecette['id'],$currentlinkphoto['idRecette']) == 0) {
					
					foreach ( $photos as $photo ) {
		    			
						if (strcmp($photo['id'],$currentlinkphoto['idPhoto']) == 0) {
							
							array_push($recettes[$i]['photos'], $photo['nom']);
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
		$recette = Recette::find($id);

		// On ajoute le pays pour la recette.
		$recette['country'] = array();
		$countries = Country::where('id', '=', $recette['idPays'])->firstOrFail();
		$recette['country'] = $countries->nom;

		// On ajoute les auteurs pour la recette.
	 	$recette['authors'] = array();
	 	$listIdauthors = DB::table('link_recette_author')->where('idRecette', '=', $recette['id'])->lists('idAutheur'); // On recherche les id de tous les auteurs de la recette
	 	$autheurs = Autheur::whereIn('id',$listIdauthors)->lists('nom'); // on recherche tous les noms des auteurs de la recette.
	 	$recette['authors'] = $autheurs;

		// On ajoute les catégories pour la recette.
		$recette['categories'] = array();
	 	$listIdcategories = DB::table('link_recette_categorie')->where('idRecette', '=', $recette['id'])->lists('idCategorie');
	 	$categories = Categorie::whereIn('id',$listIdcategories)->lists('nom');
	 	$recette['categories'] = $categories;

		// On ajoute les photos pour chaque recette.
		$recette['photos'] = array();
	 	$listIdphotos = DB::table('link_recette_photo')->where('idRecette', '=', $recette['id'])->lists('idPhoto');
	 	$photos = Photo::whereIn('id',$listIdphotos)->lists('nom');
	 	$recette['photos'] = $photos;

		// On ajoute la liste de chaque categorie d'ingredients pour chaque recette.
		$recette['ingredients'] = array();
	 	$listIdCategorieIngred = DB::table('link_recette_ingred')->where('idRecette', '=', $recette['id'])->distinct()->lists('idCategorie');
	 	$listIdIngred = DB::table('link_recette_ingred')->where('idRecette', '=', $recette['id'])->lists('idIngredient');
	 	$listQuantIngred = DB::table('link_recette_ingred')->where('idRecette', '=', $recette['id'])->lists('idQuantite');
	 	$listOrdreIngred = DB::table('link_recette_ingred')->where('idRecette', '=', $recette['id'])->lists('Ordre');

	 		// On met dans un tableau le nombre d'ingredient par categorie
	 	$listNbrIngrParCat = array();
	 	foreach ($listIdCategorieIngred as $idCatIngre) {
	 		$listNbrIngrParCat[sizeof($listNbrIngrParCat)] = DB::table('link_recette_ingred')->where('idRecette', '=', $recette['id'])->where('idCategorie', '=', $idCatIngre)->distinct()->count();
	 	
	 	}
	 		//On récupère le nom des catégories.
	 	$nomsCatIngredients = CategorieIngredient::whereIn('id',$listIdCategorieIngred)->lists('nom');
	 	$ingredients=array();
	 	foreach ($listIdIngred as $idIngredCurrent) {
	 		$ing = Ingredient::where('id','=',$idIngredCurrent)->firstOrFail();
	 		array_push($ingredients, $ing->nom);
	 	}
	 	
		$ingredientsFinal = array();
	 	for ($j=0; $j < sizeof($listIdCategorieIngred) ; $j++) { 

	 		$ingredientsArray = array();

	 		$offset = 0; // on a créé un décalage pour parcourir la lsite des ingrédients.
	 		if ($j != 0) { $offset = $listNbrIngrParCat[$j - 1]; }
	 		
	 		for ($i=0 + $offset; $i < $listNbrIngrParCat[$j] + $offset ; $i++) { 
				$ingredientsArray[$i] = array('Ordre' => $listOrdreIngred[$i],'Ingredient' => $ingredients[$i],'lien' => "");
	 		}

	 		$ingredientsFinal[$j] = array('Titre' => $nomsCatIngredients[$j],'DetailsIngre' => $ingredientsArray);
	 	}
	 	
	 	$recette['ingredients'] = $ingredientsFinal;


		// On ajoute la liste de chaque categorie de préparations pour la recette.

		$recette['preparations'] = array();
	 	$listIdCategoriePrepa = DB::table('link_recette_preparation')->where('idRecette', '=', $recette['id'])->distinct()->lists('idCatPrepa');
	 	$listIdPhrasePrepa = DB::table('link_recette_preparation')->where('idRecette', '=', $recette['id'])->lists('idPhrasePrepa');
	 	$listOrdrePhrase = DB::table('link_recette_preparation')->where('idRecette', '=', $recette['id'])->lists('Ordre');

	 		// On met dans un tableau le nombre de phrase de préparation par categorie
	 	$listNbrPhraseParCat = array();
	 	foreach ($listIdCategoriePrepa as $idCatPrepa) {
	 		$listNbrPhraseParCat[sizeof($listNbrPhraseParCat)] = DB::table('link_recette_preparation')->where('idRecette', '=', $recette['id'])->where('idCatPrepa', '=', $idCatPrepa)->distinct()->count();
	 	
	 	}
	 		//On récupère le nom des catégories de préparation.
	 	$nomsCatPhrase = CategoriePrepa::whereIn('id',$listIdPhrasePrepa)->lists('nom');
	 	$phrases=array();
	 	foreach ($listIdPhrasePrepa as $idPhrasePrepaCurrent) {
	 		$phrase = PhrasePrepa::where('id','=',$idPhrasePrepaCurrent)->firstOrFail();
	 		array_push($phrases, $phrase->phrase);
	 	}
	 	
		$phrasesFinal = array();
	 	for ($j=0; $j < sizeof($listIdCategoriePrepa) ; $j++) { 

	 		$phrasesArray = array();

	 		$offset = 0; // on a créé un décalage pour parcourir la lsite des ingrédients.
	 		if ($j != 0) { $offset = $listNbrPhraseParCat[$j - 1]; }
	 		
	 		for ($i=0 + $offset; $i < $listNbrPhraseParCat[$j] + $offset ; $i++) { 
				$phrasesArray[$i] = array('Ordre' => $listOrdrePhrase[$i],'Phrase' => $phrases[$i]);
	 		}

	 		$phrasesFinal[$j] = array('Titre' => $nomsCatPhrase[$j],'Phrases' => $phrasesArray);
	 	}
	 	
	 	$recette['preparations'] = $phrasesFinal;

		return Response::json($recette);
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