<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\BankSampah;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('authfirebase');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banksampah = BankSampah::count();
        $client = User::where('role','client')->count();
        $localhero = User::where('role','localhero')->count();
        return view('dashboard', compact('banksampah', 'client', 'localhero'));
    }
    public function login()
    {
        return view('auth.login');
    }
    public function manualbook()
    { 
        return view('layouts.manualbook');
    }
    
}
