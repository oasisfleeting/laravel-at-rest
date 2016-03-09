<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class SpnetAuthMiddleware
 *
 * @package App\Http\Middleware
 */
class SpnetAuthMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 *
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$superadmin = app('session')->get('gid');

		if ($superadmin != '1')
		{
			return redirect('dashboard')->with('msgstatus', 'error')->with('messagetext', $superadmin);
		}

		return $next($request);
	}
}
