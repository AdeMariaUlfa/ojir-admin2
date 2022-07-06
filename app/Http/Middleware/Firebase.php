<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Session;
class Firebase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $dataUser = Session::get('dataUser');
        if($dataUser == null){
            return redirect('login');
        }else{
            //$roleLogin = $dataUser['role'];
            //if(in_array($roles, $roleLogin)){
                return $next($request);
           // }else{
                //return abort(403, 'anda tidak memiliki akses!');
            //}
        }
        // return redirect('login');
    }
}
