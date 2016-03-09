<?php  namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

/**
 * Class ListingsphotosController
 *
 * @package App\Http\Controllers
 */
class ListingsphotosController extends Controller
{

	protected $layout = "layouts.main";
	protected $data = array();
	public $module = 'listingsphotos';
	static $per_page = '10';

	/**
	 *
	 */
	public function __construct()
	{

		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->model  = new Listingsphotos();
		$this->info   = $this->model->makeInfo($this->module);
		$this->access = $this->model->validAccess($this->info['id']);

		$this->data = array('pageTitle' => $this->info['title'], 'pageNote' => $this->info['note'], 'pageModule' => 'listingsphotos', 'return' => self::returnUrl()

		);

	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return mixed
	 */
	public function getIndex(Request $request)
	{

		if ($this->access['is_view'] == 0)
		{
			return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
		}

		return view('listingsphotos.index', $this->data);
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param null                     $id
	 *
	 * @return mixed
	 */
	function getUpdate(Request $request, $id = null)
	{

		if ($id == '')
		{
			if ($this->access['is_add'] == 0)
			{
				return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
			}
		}

		if ($id != '')
		{
			if ($this->access['is_edit'] == 0)
			{
				return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
			}
		}

		$this->data['access'] = $this->access;

		return view('listingsphotos.form', $this->data);
	}

	/**
	 * @param null $id
	 *
	 * @return mixed
	 */
	public function getShow($id = null)
	{

		if ($this->access['is_detail'] == 0)
		{
			return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
		}

		$this->data['access'] = $this->access;

		return view('listingsphotos.view', $this->data);
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 */
	function postSave(Request $request)
	{

	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return mixed
	 */
	public function postDelete(Request $request)
	{

		if ($this->access['is_remove'] == 0)
		{
			return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
		}

	}

}