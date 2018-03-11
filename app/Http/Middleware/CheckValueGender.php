<?php

namespace App\Http\Middleware;

use Closure;

class CheckValueGender
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
        if ($request->get('gender')!='male' && $request->get('gender')!='female') {
            return redirect()->route('profile.edit');
        };

        return $next($request);
    }
}
