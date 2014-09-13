<?php

class RecipesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /recipes
	 *
	 * @return Response
	 */
	public function search($txt)
	{
		echo "couco = ".$txt;
		return Response::json($txt);
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
		//
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