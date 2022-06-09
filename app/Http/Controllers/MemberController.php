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
    public function indexMember(Request $request)
    {
        if($request->has('search')){
            $data = Member::where('gender','LIKE','%' .$request->search.'%')->paginate(5);
        }else{
            $data = Member::paginate(10);
        }
        
        return view('member.member', compact('data'));
    }
    public function updateMember($id)
    {
        User::find($id)->update(['status'=>'yes']);
        return redirect()->back();
    }
    public function rejectMember($id)
    {
        User::find($id)->update(['status'=>'no']);
        return redirect()->back();
    }

    public function indexClient()
    {
        $id = Auth::user()->id;
        $banksampah = BankSampah::where('user_id', $id)->first();
        $data = User::join('members','members.user_id','=','users.id')->where(
            'users.role','client')->where('banksampah_id', $banksampah->id)->select(
            'members.*','users.*')->get();
        return view('member.client', compact('data'));
    }
    public function updateClient($id)
    {
        User::find($id)->update(['status'=>'yes']);
        return redirect()->back();
    }
    public function rejectClient($id)
    {
        User::find($id)->update(['status'=>'no']);
        return redirect()->back();
    }
    public function indexLocalHero()
    {
        $id = Auth::user()->id;
        $banksampah = BankSampah::where('user_id', $id)->first();
        $data = User::join('members','members.user_id','=','users.id')->where(
            'users.role','localhero')->where('banksampah_id', $banksampah->id)->select(
            'members.*','users.*')->get();
        return view('member.localhero', compact('data'));
    }
    public function updateLocalHero($id)
    {
        User::find($id)->update(['status'=>'yes']);
        return redirect()->back();
    }
    public function rejectLocalHero($id)
    {
        User::find($id)->update(['status'=>'no']);
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
