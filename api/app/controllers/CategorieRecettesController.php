<?php

class CategorieRecettesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /categorierecettes
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	

	/**
	 * Store a newly created resource in storage.
	 * POST /categorierecettes
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /categorierecettes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//On sélectionne les recettes pour une catégorie
		$recettes = DB::table('link_recette_categorie')
            ->join('recettes', 'link_recette_categorie.idRecette', '=', 'recettes.id')
            ->join('categories', 'link_recette_categorie.idCategorie', '=', 'categories.id')
            ->where('categories.id', '=', $id )
            ->select('recettes.*')
            ->get();

        $recettesCopy = $recettes;

        //echo Response::json($recettes);

        $cpt = 0;
        foreach ($recettesCopy as $recette) {
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

		 	$recettes[$cpt] = $recette;

		 	$cpt++;
        }

		return Response::json($recettes);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /categorierecettes/{id}
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
	 * DELETE /categorierecettes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}