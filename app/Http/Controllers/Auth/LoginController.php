<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    private $firebaseUser;
    protected $redirectTo = RouteServiceProvider::LOGIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->firebaseUser = new \App\Models\Firebase\UserFirebase();
    }

    public function loginFirebase(Request $request){
        $dataUser = $this->firebaseUser->loginFirebase($request->email);
        //return $dataUser;
        if($dataUser == null)
        {
            return redirect()->back()->with('success','email tidak ditemukan!');
        }else{
            if(!Hash::check($request->password, $dataUser['password'])){
                return redirect()->back()->with('success','password salah!');
            }else{
                if($dataUser['status'] == 'yes'){
                    //return $dataUser;
                    Session::put('dataUser',$dataUser);
                    return redirect('home');
                }else{
                    return redirect()->back()->with('success','Akun anda belum diverifikasi!');
                }
            }
        }
    }

    public function logoutFirebase()
    {
        Session::forget('dataUser');
        return redirect('/');
    }
}
