<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BankSampah;
use Illuminate\Http\Request;

class BankSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $firebaseBankSampah;
    public function __construct()
    {
        //$this->middleware('authfirebase');
        $this->firebaseBankSampah = new \App\Models\Firebase\BankSampahFirebase();
    }

    public function index(Request $request)
    {
        if($request->has('search')){
            //$data = BankSampah::where('pemilik','LIKE','%' .$request->search.'%')->paginate(5);
            //firebase
            $data = $this->firebaseBankSampah->search($request->search,5);
        }else{
           // $data = BankSampah::paginate(10);
            //firebase
            $data = $this->firebaseBankSampah->getAll();
        }
        //return $data;
        return view('banksampah.banksampah', compact('data'));
    }

    public function update($id)
    {
        //User::find($id)->update(['status'=>'yes']);
        $this->firebaseBankSampah->updateOrReject($id,'yes');
        return redirect()->back();
    }
    public function reject($id)
    {
        //User::find($id)->update(['status'=>'no']);
        //firebase
        $this->firebaseBankSampah->updateOrReject($id,'no');
        return redirect()->back();
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankSampah  $bankSampah
     * @return \Illuminate\Http\Response
     */
    public function show(BankSampah $bankSampah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankSampah  $bankSampah
     * @return \Illuminate\Http\Response
     */
    public function edit(BankSampah $bankSampah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankSampah  $bankSampah
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankSampah  $bankSampah
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankSampah $bankSampah)
    {
        //
    }
}
