<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class IpblockedMiddleware
 *
 * @package App\Http\Middleware
 */
class IpblockedMiddleware
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

		if (CNF_ALLOWIP != '')
		{
			$ipsAllow = explode(',', preg_replace('/\s+/', '', CNF_ALLOWIP));
			if (count($ipsAllow) >= 1)
			{
				//                echo count($ipsAllow);exit;
				if (!in_array($request->ip(), $ipsAllow))
				{
					return redirect('restric');
				}
			}
		}

		$ips = explode(',', preg_replace('/\s+/', '', CNF_RESTRICIP));
		if (is_array($ips))
		{
			if (in_array($request->ip(), $ips))
			{
				return redirect('restric');
			}
		}

		return $next($request);
	}
}
