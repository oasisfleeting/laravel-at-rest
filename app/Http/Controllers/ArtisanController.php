<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Mockery\CountValidator\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ArtisanController
 *
 * @package App\Http\Controllers
 */
class ArtisanController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		//		switch ($cmd)
		//		{
		//			//returns arrays or arrays of object requires special parsing for output
		//			case 'fetchlistings':
		//				return $this->$cmd($cmd);
		//				break;
		//			default:
		//				return $this->genericCommand($cmd);
		//				break;
		//		}
	}

	/**
	 * @param $cmd
	 *
	 * @return mixed
	 */
	public function genericCommand($cmd)
	{
		try
		{
			if (in_array($cmd, $this->checkCommand(), true))
			{
				Artisan::call($cmd, $args = array());
				$out        = Artisan::output();
				$resp       = new \stdClass();
				$resp->type = 'type';
				$resp->out  = $out;

				return response()->json($resp);
			}
		} catch (Exception $e)
		{
			Response::make($e->getMessage(), 500);
		}
	}

	/**
	 * @param $cmd
	 *
	 * @return mixed
	 */
	public function fetchlistings($cmd)
	{
		try
		{
			Artisan::call('parselistings', $args = array());
		} catch (Exception $e)
		{
			Response::make($e->getMessage(), 500);
		}

		$sort           = 'id';
		$order          = 'asc';
		$filter         = '';
		$page           = 1;
		$params         = array('page' => $page, 'limit' => 100, 'sort' => $sort, 'order' => $order, 'params' => $filter, 'global' => 1,);
		$spListing      = new \App\Models\Listing();
		$spListingPhoto = new \App\Models\Listingsphotos();
		$rows           = $spListing->getRows($params);
		$html_imgs      = '';
		$html           = '';

		for ($i = 0; $i < count($rows['rows']); $i++)
		{
			$row = $rows['rows'][$i];

			$params['params'] = " AND listings_photos.Public = 1 AND listings_photos.listingId = " . $row->id;
			$photos           = $spListingPhoto->getRows($params)['rows'];
			for ($j = 0; $j < count($photos); $j++)
			{
				$key       = 'photo' . $j;
				$val       = $photos[$j]->MediaURL;
				$row->$key = '<img style="width:50px;" src="' . $val . '"/>';
			}
			$html .= '<div class="clearfix row">';
			$html .= '<dl class="dl-horizontal">';

			$k = 0;
			foreach ($row as $key => $val)
			{
				if (strpos($key, 'photo') !== false)
				{
					$html_imgs .= '<span class="col-md-1">' . $val . '</span>';
				}
				else
				{
					$html .= '<dt class="clearfix">' . $key . '</dt>';
					$html .= '<dd class="clearfix" style="white-space:normal">' . $val . '</dd>';
				}

			}
			$html .= '</dl>';
			$html .= '<div class="row" style="height:60px;">' . $html_imgs . '</div>';
			$html .= '</div>';
			$html_imgs = '';

			$rows['rows'][$i] = $html;
			$html             = '';

		}
		$resp           = new \stdClass();
		$resp->type     = 'print';
		$out            = implode(' ', $rows['rows']);
		$resp->out      = $out;
		$resp->callback = 'scrolltoprompt';

		return response()->json($resp);
	}

	/**
	 * @return array
	 */
	public function checkCommand()
	{
		$commands = array('clear-compiled', 'down', 'env', 'help', 'inspire', 'list', 'migrate', 'optimize', 'serve', 'tinker', 'up', 'app:name', 'auth:clear-resets', 'cache:clear', 'cache:table', 'config:cache', 'config:clear', 'db:seed', 'event:generate', 'handler:command', 'handler:event', 'ide-helper:generate', 'ide-helper:meta', 'ide-helper:models', 'key:generate', 'make:command', 'make:console', 'make:controller', 'make:event', 'make:job', 'make:listener', 'make:middleware', 'make:migration', 'make:model', 'make:policy', 'make:provider', 'make:request', 'make:seeder', 'make:test', 'migrate:install', 'migrate:refresh', 'migrate:reset', 'migrate:rollback', 'migrate:status', 'queue:failed', 'queue:failed-table', 'queue:flush', 'queue:forget', 'queue:listen', 'queue:restart', 'queue:retry', 'queue:subscribe', 'queue:table', 'queue:work', 'route:cache', 'route:clear', 'route:list', 'schedule:run', 'session:table', 'vendor:publish', 'view:clear');

		return $commands;
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
}
