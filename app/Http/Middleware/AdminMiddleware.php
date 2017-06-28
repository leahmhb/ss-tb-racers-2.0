<?php
namespace App\Http\Middleware;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use Closure;

class AdminMiddleware{

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)	{
    if (Auth::guest()) {
     return abort(401);
   }


   if ($request->user()->isAdmin == 1) {
    return $next($request);
  }

  return abort(401);
}

}
