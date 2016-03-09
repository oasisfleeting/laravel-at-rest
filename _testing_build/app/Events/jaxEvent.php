<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class jaxEvent
 *
 * @package App\Events
 */
class jaxEvent extends Event
{
	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Get the channels the event should be broadcast on.
	 *
	 * @return array
	 */
	public function broadcastOn()
	{
		return [];
	}
}
