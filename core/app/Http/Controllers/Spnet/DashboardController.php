<?php namespace App\Http\Controllers\spnet;

use App\Groups;
use App\Http\Controllers\controller;
use Illuminate\Http\Request;


class DashboardController extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function getIndex( Request $request )
	{

		return view('dashboard.index');
	}	


}
