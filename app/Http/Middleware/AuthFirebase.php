<?php
namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Http\Request;
class AuthFirebase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $dataUser = Session::get('dataUser');
        //dd($dataUser['role']);
       //in_array(needle, haystack)
        if($dataUser == null){
            return redirect('login');
        }else{
            $roleLogin = $dataUser['role'];
            if(in_array($roleLogin,$roles)){
                return $next($request);
           }else{
                return abort(403, 'anda tidak memiliki akses!');
            }
        }
        // return redirect('login');
    }
}