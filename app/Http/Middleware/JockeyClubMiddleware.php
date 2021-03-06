<?php
namespace App\Http\Middleware;
use Illuminate\Http\RedirectResponse;


use Closure;

class JockeyClubMiddleware{

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) {
    if (Auth::guest()) {
     return abort(401);
   }

   if ($request->user()->isJockeyClub == 1) {
    return $next($request);
  }

    return abort(401);
}

}
