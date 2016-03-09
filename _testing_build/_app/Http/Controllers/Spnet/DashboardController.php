<?php  namespace App\Http\Controllers\spnet;

use App\Groups;
use App\Http\Controllers\controller;
use Illuminate\Http\Request;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\spnet
 */
class DashboardController extends Controller {

	/**
	 *
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return mixed
	 */
	public function getIndex( Request $request )
	{

		return view('dashboard.index');
	}	


}
