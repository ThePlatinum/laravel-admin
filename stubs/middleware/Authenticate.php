<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
  /**
   * Get the path the user should be redirected to when they are not authenticated.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @param  string|null  ...$guards
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle($request, $next, ...$guards)
  {
      if (!$request->expectsJson()) {

          $guards = empty($guards) ? [null] : $guards;

          foreach ($guards as $guard) {
              if ((str_contains($guard, 'admin'))) {
                  return redirect()->route('admin.login');
              } else {
                  return route('login');
              }
          }
        
      }
  }
}
