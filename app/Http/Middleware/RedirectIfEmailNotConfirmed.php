<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfEmailNotConfirmed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && !$request->user()->confirmed) {
            return redirect('/')->with(['flash'=>['type'=>'i','message'=>'You must first confirm your email address']]);
        }
        return $next($request);
    }
}
