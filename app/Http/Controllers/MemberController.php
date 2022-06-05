<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;

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
        $data = User::where('role','client')->with('member')->get();
        // dd($data);
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
