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
				return $this->customCommand($com);
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

				return response()->json(Artisan::output());
			}
		} catch (Exception $e)
		{
			Response::make($e->getMessage(), 500);
		}
	}

	public function customCommand($com)
	{
		try
		{
			Artisan::call($com, $args = array());
			$resp = Artisan::output();
			$out  = array();
			parse_str($resp, $out);

			return response()->json($out);

		} catch (Exception $e)
		{
			Response::make($e->getMessage(), 500);
		}
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
