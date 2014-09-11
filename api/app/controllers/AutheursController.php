<?php

class AutheursController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /autheurs
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Autheur::get());
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /autheurs
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /autheurs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /autheurs/{id}
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
	 * DELETE /autheurs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}