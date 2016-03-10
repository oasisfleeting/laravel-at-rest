<?php  namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Redirect;
use Validator;

/**
 * Class ListingController
 *
 * @package App\Http\Controllers
 */
class ListingController extends Controller
{

	static $per_page = '10';
	public $module = 'listing';
	protected $layout = "layouts.main";
	protected $data = array();

	/**
	 *
	 */
	public function __construct()
	{

		//$this->beforeFilter('csrf', array('on' => 'post'));
		//		$this->model = new Listing();
		//
		//		$this->info = $this->model->makeInfo($this->module);
		//		print_r($this->info);
		//		$this->access = $this->model->validAccess($this->info['id']);
		//
		//		$this->data = array('pageTitle' => $this->info['title'],
		//		                    'pageNote' => $this->info['note'],
		//		                    'pageModule' => 'listing',
		//		                    'return' => self::returnUrl()
		//
		//		);

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{

		//public access for demo
		$this->access['is_view'] = 1;

		if ($this->access['is_view'] == 0)
		{
			//return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
		}

		//		echo "<pre>";
		//		print_r($request->input());

		//		$sort  = (!is_null($request->input('sort')) ? $request->input('sort') : 'id');
		//		$order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
		//		// End Filter sort and order for query
		//		// Filter Search for query
		//		$filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
		//		$page   = $request->input('page', 1);
		//		$params = array('page' => $page,
		//			            'limit' => (!is_null($request->input('rows')) ? filter_var($request->input('rows'), FILTER_VALIDATE_INT) : static::$per_page),
		//			            'sort' => $sort,
		//			            'order' => $order,
		//			            'params' => $filter,
		//			            'global' => 1); //(isset($this->access['is_global']) ? $this->access['is_global'] : 0));
		//
		$sort        = 'id';
		$order       = '';
		$filter      = '';
		$page        = 1;
		$params      = array('page' => $page, 'limit' => 100, 'sort' => $sort, 'order' => $order, 'params' => $filter, 'global' => 1,);
		$this->model = new \App\Models\Listing();
		$photoModel  = new \App\Models\Listingsphotos();
		$rows        = $this->model->getRows($params);
		$uniqueid    = 'sect_' . uniqid('scrollto', false);
		$html_imgs   = '';
		$html        = '';
		//print_r($params);

		// Get Query
		$results = $this->model->getRows($params);

		//print_r($results);

		// Build pagination setting
		$page       = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
		$pagination = new Paginator($results['rows'], $results['total'], $params['limit']);
		$pagination->setPath('listing');

		$this->data['rowData'] = $results['rows'];
		// Build Pagination
		$this->data['pagination'] = $pagination;
		// Build pager number and append current param GET
		$this->data['pager'] = $this->injectPaginate();
		// Row grid Number
		$this->data['i'] = ($page * $params['limit']) - $params['limit'];
		//		// Grid Configuration
		//		$this->data['tableGrid'] = $this->info['config']['grid'];
		//		$this->data['tableForm'] = $this->info['config']['forms'];
		//		$this->data['colspan']   = \SiteHelpers::viewColSpan($this->info['config']['grid']);
		//		// Group users permission
		//		$this->data['access'] = $this->access;
		//		// Detail from master if any
		//
		//		// Master detail link if any
		//		$this->data['subgrid'] = (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array());

		$this->data['pageTitle'] = 'Listings';
		$this->data['pageNote']  = 'Listings';
		//\Session::put('themes', 'spnet');

		$this->data['pageMetakey']  = CNF_METAKEY;
		$this->data['pageMetadesc'] = CNF_METADESC;

		$this->data['pages'] = 'pages.listings';
		$page                = 'layouts.' . CNF_THEME . '.index';
		// Render into template
		return view($page, $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
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

		$row = $this->model->find($id);
		if ($row)
		{
			$this->data['row'] = $row;
		}
		else
		{
			$this->data['row'] = $this->model->getColumnTable('listings');
		}
		$this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['forms']);

		$this->data['id'] = $id;

		return view('listing.form', $this->data);
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

		$row = $this->model->getRow($id);
		if ($row)
		{
			$this->data['row'] = $row;
		}
		else
		{
			$this->data['row'] = $this->model->getColumnTable('listings');
		}
		$this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['grid']);

		$this->data['id']     = $id;
		$this->data['access'] = $this->access;

		return view('listing.view', $this->data);
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return mixed
	 */
	function postSave(Request $request)
	{

		$rules     = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes())
		{
			$data = $this->validatePost('tb_listing');

			$id = $this->model->insertRow($data, $request->input('id'));

			if (!is_null($request->input('apply')))
			{
				$return = 'listing/update/' . $id . '?return=' . self::returnUrl();
			}
			else
			{
				$return = 'listing?return=' . self::returnUrl();
			}

			// Insert logs into database
			if ($request->input('id') == '')
			{
				\SiteHelpers::auditTrail($request, 'New Data with ID ' . $id . ' Has been Inserted !');
			}
			else
			{
				\SiteHelpers::auditTrail($request, 'Data with ID ' . $id . ' Has been Updated !');
			}

			return Redirect::to($return)->with('messagetext', \Lang::get('core.note_success'))->with('msgstatus', 'success');

		}
		else
		{

			return Redirect::to('listing/update/' . $id)->with('messagetext', \Lang::get('core.note_error'))->with('msgstatus', 'error')->withErrors($validator)->withInput();
		}

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
		// delete multipe rows 
		if (count($request->input('ids')) >= 1)
		{
			$this->model->destroy($request->input('ids'));

			\SiteHelpers::auditTrail($request, "ID : " . implode(",", $request->input('ids')) . "  , Has Been Removed Successfull");

			// redirect
			return Redirect::to('listing')->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus', 'success');

		}
		else
		{
			return Redirect::to('listing')->with('messagetext', 'No Item Deleted')->with('msgstatus', 'error');
		}

	}

}