<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use App\Models\BankSampah;
use Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $firebaseMember;
    private $firebaseData;
    private $firebaseBankSampah;
    private $firebasePoint;
    public function __construct()
    {
        $this->firebasePoint = new \App\Models\Firebase\PointFirebase();
        $this->firebaseBankSampah = new \App\Models\Firebase\BankSampahFirebase();
        $this->firebaseData = new \App\Models\Firebase\FirebaseData();
        $this->firebaseMember = new \App\Models\Firebase\MemberFirebase();
    }
    public function indexMember(Request $request)
    {
        $search = null;
        if($request->has('search')){
           $search = $request->search;
        }

        if($this->firebaseData->auth()['role'] == 'admin'){
            $data = $this->firebaseMember->getAll($search);
        }else{
            $data = $this->firebaseMember->getAllByBankSampa($this->firebaseData->auth()['banksampah_id'],$search);
        }
        
        return view('member.member', compact('data'));
    }
    public function updateMember($id)
    {
        //User::find($id)->update(['status'=>'yes']);
        $this->firebaseMember->updateOrReject($id,'yes');
        return redirect()->back();
    }
    public function rejectMember($id)
    {
        //User::find($id)->update(['status'=>'no']);
        $this->firebaseMember->updateOrReject($id,'no');
        return redirect()->back();
    }

    public function indexClient(Request $request)
    {
        $search = null;
        if($request->has('search')){
           $search = $request->search;
        }
        $id = $this->firebaseData->auth()['id'];
        $banksampah = $this->firebaseBankSampah->getByUserId($id);
        $data = $this->firebaseMember->getByBankSampahId($banksampah['id'],$search);
        return view('member.client', compact('data'));
    }
    public function updateClient($id)
    {
        //User::find($id)->update(['status'=>'yes']);
        $this->firebaseMember->updateOrReject($id,'yes');
        return redirect()->back();
    }
    public function rejectClient($id)
    {
        //User::find($id)->update(['status'=>'no']);
        $this->firebaseMember->updateOrReject($id,'no');
        return redirect()->back();
    }
    public function indexLocalHero(Request $request)
    {
        $search = null;
        if($request->has('search')){
           $search = $request->search;
        }
        $id = $this->firebaseData->auth()['id'];
        $banksampah = $this->firebaseBankSampah->getByUserId($id);
        $data = $this->firebaseMember->getDriver($this->firebaseData->auth()['banksampah_id'],$search);
       // return $data;
        return view('member.localhero', compact('data'));
    }
    public function updateLocalHero($id)
    {
        //User::find($id)->update(['status'=>'yes']);
        $this->firebaseMember->updateOrReject($id,'yes');
        return redirect()->back();
    }
    public function rejectLocalHero($id)
    {
        //User::find($id)->update(['status'=>'no']);
        $this->firebaseMember->updateOrReject($id,'no');
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
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}
