<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\BankSampah;
use App\Models\Member;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $banksampah = BankSampah::count();
        $member = Member::count();
        return view('welcome2', compact('banksampah', 'member'));
    }
}
