<?php
namespace App\Http\Middleware;
use Illuminate\Http\RedirectResponse;


use Closure;

class OwnerMiddleware{

/**
* Handle an incoming request.
*
* @param  \Illuminate\Http\Request  $request
* @param  \Closure  $next
* @return mixed
*/
public function handle($request, Closure $next) {

  if ($this->auth->guest()) {
    return abort(401);
  }

  if($request->user()->isOwner == 1 ){
    return $next($request);
  }


  return abort(401);

}

}