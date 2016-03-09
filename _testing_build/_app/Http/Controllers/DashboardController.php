<?php  namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{

	/**
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return mixed
	 */
	public function getIndex(Request $request)
	{
		if(\Auth::check())
		{
			$this->data['online_users'] = \DB::table('tb_users')->orderBy('last_activity', 'desc')->limit(10)->get();

			return view('dashboard.index', $this->data);
		}else{
			return Redirect::to('/')->with('message', \SiteHelpers::alert('success','Login using the terminal'));
		}
	}

}
