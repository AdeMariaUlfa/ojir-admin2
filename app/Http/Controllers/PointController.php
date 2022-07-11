<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Point;
use App\Models\DetailPoint;
use App\Models\BankSampah;
use Illuminate\Http\Request;
use Auth;
use Session;
class PointController extends Controller
{
     private $firebaseData;
     private $firebaseBankSampah;
     private $firebasePoint;
     public function __construct()
     {
        //$this->middleware('authfirebase');
        $this->firebasePoint = new \App\Models\Firebase\PointFirebase();
        $this->firebaseBankSampah = new \App\Models\Firebase\BankSampahFirebase();
        $this->firebaseData = new \App\Models\Firebase\FirebaseData();
     }
    public function index()
    {
        $id = $this->firebaseData->auth()['id'];
        $banksampah = $this->firebaseBankSampah->getByUserId($id);
        // $data = Point::join('bank_sampahs','bank_sampahs.id','=','points.banksampah_id')->where(
        //     'bank_sampahs.id',$banksampah->id)->select(
        //     'points.*')->get();
        $data = $this->firebasePoint->getPointByBankSampahIdUser($banksampah['id']);
        //return $data;
        return view('banksampah.point', compact('data'));
    }
    public function addpoint()
    {
        return view('banksampah.tambah-point');
    }
    public function postpoint(Request $request)
    {
        //return $request;
        $idBS = $this->firebaseData->auth()['id'];
        //return $idBS;
        $banksampah = $this->firebaseBankSampah->getByUserId($idBS);
        //return $banksampah;
        // Point::create(['jenis_sampah'   => $request->input('jenis_sampah'),
        //                'point'          => $request->input('point'),
        //                'berat'          => $request->input('berat'),                
        //                'banksampah_id'  => $banksampah->id]);
        $post = $this->firebasePoint->postpoint($request,$banksampah['id']);
        //return $post;
        return redirect()->route('point')->with('success','data berhasil ditambahkan!');
    }
    public function viewpoint($id)
    { 
        //$data = Point::find($id);
        // dd($data);
        $data = $this->firebasePoint->getPointById($id);
        //return $data;
        return view('banksampah.view-point',compact('data'));
    }
    public function updatepoint(Request $request, $id)
    {
        //$data = Point::find($id);
        //$data->update($request->all());
        $this->firebasePoint->updatePoint($request,$id);
        return redirect()->route('point')->with('success','data berhasil diupdate!');
    }
    public function deletepoint($id)
    {
        //$data = Point::find($id);
        //$data->delete();
        $this->firebasePoint->deletePoint($id);
        return redirect()->route('point')->with('success','data berhasil dihapus!');
    }


    public function indexMember()
    {
        $data = DetailPoint::join('users','users.id','=','detail_points.user_id')->select(
            'detail_points.*','users.name')->get();
        return view('pointdetail.point-detail', compact('data'));
    }
    // public function addpointMember()
    // {
    //     $bs = BankSampah::join('users','users.id','=','bank_sampahs.user_id')->select(
    //     'bank_sampahs.id','users.name')->get();
    //     $client = User::where('role','client')->get();
    //     return view('pointdetail.tambah-point', compact('bs','client'));
    // }
    // public function postpointMember(Request $request)
    // {
    //     $bs = Point::where('banksampah_id', $request->banksampah_id)->where(
    //         'berat','<=',$request->berat)->first();
    //         if($bs == null){
    //             DetailPoint::create([
    //             'user_id'        => $request->input('user_id'),
    //             'point'          => 0,
    //             'jumlah'         => $request->input('berat')]);
    //         }
    //         else{
    //             DetailPoint::create(['user_id'        => $request->input('user_id'),
    //                    'point'          => (int) $bs->point,
    //                    'jumlah'          => $request->input('berat')]);
    //         }
        
    //     return redirect()->route('pointMember')->with('success','data berhasil ditambahkan!');
    // }
    
    public function laporan()
    {
        // tolong ditambahkan untuk penjumlahan total point dan berat, terimakasih
        $id = $this->firebaseData->auth()['id'];
        $banksampah = BankSampah::where('user_id', $id)->first();
        $data = DetailPoint::join('users','users.id','=','detail_points.user_id')->select(
            'detail_points.*','users.name')->get();
        return view('banksampah.laporan', compact('data'));
    }

    public function getGurrentPointBankSampa(Request $request)
    {
        if($request->banksampah_id != null){
            if($request->berat != null){
                $data =  $this->firebasePoint->getPointByBankSampahIdReal($request->banksampah_id,$request->berat);
                if(count($data) > 0){
                   // $berat = $request->berat;
                    //$result = $data['harga'] * $berat;
                    return response()->json([
                        'status'=>'success',
                        'result'=>$data
                    ]);
                }else{
                    return response()->json([
                        'status'=>'error',
                        'result'=>'point was not found!'
                    ]);
                }
            }else{
                return response()->json([
                        'status'=>'error',
                        'result'=>'berat is required!'
                    ]);
            }
        }else{
            return response()->json([
                        'status'=>'error',
                        'result'=>'banksampah_id is required!'
                    ]);
        }
    }

    public function getAllPoints()
    {
         $data =  $this->firebasePoint->getAllPoints();
         return response()->json([
            'status'=>'success',
            'result'=>$data
        ]);
    }
}
