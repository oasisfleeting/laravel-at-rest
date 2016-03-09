<?php

namespace App\Listeners;

use App\Events\SomeEvent;

/**
 * Class EventListener
 *
 * @package App\Listeners
 */
class EventListener
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  SomeEvent $event
	 *
	 * @return void
	 */
	public function handle(SomeEvent $event)
	{
		//
		shell_exec('php ../../artisan');
	}
}
