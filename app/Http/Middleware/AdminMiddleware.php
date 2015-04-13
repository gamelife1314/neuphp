<?php namespace App\Http\Middleware;

use Closure;
use \Auth;

class AdminMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
	    else if (!Auth::check() || Auth::user()->is_admin != 1 || Auth::user()->is_banned == 1)
	    {
	    	return redirect()->home();
	    }
		return $next($request);
	}

}
