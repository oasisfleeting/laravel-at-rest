<?php  namespace App\Http\Controllers\Core;

use App\Http\Controllers\controller;
use Illuminate\Http\Request;

/**
 * Class ElfinderController
 *
 * @package App\Http\Controllers\Core
 */
class ElfinderController extends Controller {

	/**
	 *
	 */
	public function __construct()
	{

	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return mixed
	 */
	public function getIndex( Request $request )
	{
		$data = array();
		//return public_path().'/uploads/userfiles/';
		if(!is_dir(public_path().'/uploads/userfiles/')) mkdir(public_path().'/uploads/userfiles/',0777);
		$groupID = \Session::get('gid');
		if($groupID ==1 or $groupID ==2 ) 
		{
			$data['folder'] = 'uploads/'; 
		} else {
			$folder = \Session::get('uid');
			if(!is_dir('./uploads/userfiles/'.$folder )) mkdir('./uploads/userfiles/'.$folder ,0777);
			$data['folder'] = 'uploads/userfiles/'.$folder ; 
			
		}
		if(!is_null($request->get('cmd')))
		{
			return view('core.elfinder.connector',$data);

		} else {
			return view('core.elfinder.filemanager',$data);
		}
	
	}
	
	static function display()
	{
		return view('core.elfinder.filemanager');	
	} 
	
	
}
