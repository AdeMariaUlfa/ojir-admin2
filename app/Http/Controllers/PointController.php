<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Point;
use App\Models\DetailPoint;
use App\Models\BankSampah;
use Illuminate\Http\Request;
use Auth;

class PointController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $banksampah = BankSampah::where('user_id', $id)->first();
        $data = Point::join('bank_sampahs','bank_sampahs.id','=','points.banksampah_id')->where(
            'bank_sampahs.id',$banksampah->id)->select(
            'points.*')->get();
        return view('banksampah.point', compact('data'));
    }
    public function addpoint()
    {
        return view('banksampah.tambah-point');
    }
    public function postpoint(Request $request)
    {
        $idBS = Auth::user()->id;
        $banksampah = BankSampah::where('user_id', $idBS)->first();
        
        Point::create(['jenis_sampah'   => $request->input('jenis_sampah'),
                       'point'          => $request->input('point'),
                       'berat'          => $request->input('berat'),                
                       'banksampah_id'  => $banksampah->id]);
        return redirect()->route('point')->with('success','data berhasil ditambahkan!');
    }
    public function viewpoint($id)
    { 
        $data = Point::find($id);
        // dd($data);
        return view('banksampah.view-point',compact('data'));
    }
    public function updatepoint(Request $request, $id)
    {
        $data = Point::find($id);
        $data->update($request->all());
        return redirect()->route('point')->with('success','data berhasil diupdate!');
    }
    public function deletepoint($id)
    {
        $data = Point::find($id);
        $data->delete();
        return redirect()->route('point')->with('success','data berhasil dihapus!');
    }


    public function indexMember()
    {
        $id = Auth::user()->id;
        $banksampah = BankSampah::where('user_id', $id)->first();
        $data = DetailPoint::join('users','users.id','=','detail_points.user_id')->select(
            'detail_points.*','users.name')->get();
        return view('pointdetail.point-detail', compact('data'));
    }
    public function addpointMember()
    {
        $bs = BankSampah::join('users','users.id','=','bank_sampahs.user_id')->select(
        'bank_sampahs.id','users.name')->get();
        $client = User::where('role','client')->get();
        return view('pointdetail.tambah-point', compact('bs','client'));
    }
    public function postpointMember(Request $request)
    {
        $bs = Point::where('banksampah_id', $request->banksampah_id)->where(
            'berat','<=',$request->berat)->first();
            if($bs == null){
                DetailPoint::create(['user_id'        => $request->input('user_id'),
                'point'          => 0,
                'jumlah'          => $request->input('berat')]);
            }
            else{
                DetailPoint::create(['user_id'        => $request->input('user_id'),
                       'point'          => (int) $bs->point,
                       'jumlah'          => $request->input('berat')]);
            }
        
        return redirect()->route('pointMember')->with('success','data berhasil ditambahkan!');
    }
}
