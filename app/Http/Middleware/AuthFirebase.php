<?php
namespace App\Http\Middleware;

use Closure;
use Session;
class AuthFirebase
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
        if(Session::get('dataUser') != null){
            return $next($request);
        }
        return redirect('login');
    }
}