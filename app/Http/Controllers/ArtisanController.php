<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Mockery\CountValidator\Exception;
use Symfony\Component\HttpFoundation\Response;

class ArtisanController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, $com)
	{
		switch ($com)
		{
			//returns arrays or arrays of object requires special parsing for output
			case 'parselistings':
				return $this->$com($com);
				break;
			default:
				return $this->genericCommand($com);
				break;
		}
	}

	public function genericCommand($com)
	{
		try
		{
			if (in_array($com, $this->checkCommand(), true))
			{
				Artisan::call($com, $args = array());
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

	public function parselistings($com)
	{
		$request = null;
		try
		{
			Artisan::call($com, $args = array());
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
		$uniqueid       = 'sect_' . uniqid('scrollto', false);
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
			//$html = '<section class="clearfix">';
			$html .='<div class="clearfix row">';
			$html .='<dl class="dl-horizontal">';

			$k    = 0;
			foreach ($row as $key => $val)
			{
				if (strpos($key, 'photo') !== false)
				{
					//$html .= '<dt>' . $key . '</dt>';
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

			//$html .= '</div>';
			//$html .= '</section>';

			$rows['rows'][$i] = $html;
			$html = '';

		}
		#terminal > div.cmd_terminal_content > div:nth-child(2) > div > section:nth-child(5)
		//$out = $rows['rows'];
		//$out = \SiteHelpers::gridClass()

		$resp       = new \stdClass();
		$resp->type = 'print';
		$out = implode(' ', $rows['rows']);// . "<div class='clearfix'><br/>&nbsp;<br/></div>";
		//$out .= "<script>$('.cmd_terminal_content').animate({scrollTop: $('div.contentappendedtwo > div:last').position().top}, 5000).promise().always( function () { console.log($(this)); });</script>";
		//.animate({scrollTop:$('#scrolltome').last().position().top},1000);</script>";
		$resp->out  = $out;
		$resp->callback = 'scrolltoprompt';
		//$resp->exit = 'true';
		//echo "<pre>";
		//print_r($rows['rows']);
		return response()->json($resp);
	}

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
