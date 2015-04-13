<?php namespace App\Http\Middleware;

use Closure;
use \Auth;
use \App;
use Illuminate\Contracts\Routing\Middleware;

class AfterMiddleware implements Middleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

        if (Auth::check()) {

           $user_lang = Auth::user()->language;

           if (in_array($user_lang, ['en','zh-CN'])) {
               App::setlocale($user_lang);
           }

		}

		return $next($request);
	}

}
