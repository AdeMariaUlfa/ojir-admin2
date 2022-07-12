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
    public function index(Request $request)
    {
        $search = null;
        if($request->has('search')){
           $search = $request->search;
        }
        $id = $this->firebaseData->auth()['id'];
        $banksampah = $this->firebaseBankSampah->getByUserId($id);
        $data = $this->firebasePoint->getPointByBankSampahIdUser($banksampah['id'],$search);
        return view('banksampah.point', compact('data'));
    }
    public function addpoint()
    {
        return view('banksampah.tambah-point');
    }
    public function postpoint(Request $request)
    {
        $idBS = $this->firebaseData->auth()['id'];
        $banksampah = $this->firebaseBankSampah->getByUserId($idBS);
        $post = $this->firebasePoint->postpoint($request,$banksampah['id']);
        return redirect()->route('point')->with('success','data berhasil ditambahkan!');
    }
    public function viewpoint($id)
    { 
        $data = $this->firebasePoint->getPointById($id);
        //return $data;
        return view('banksampah.view-point',compact('data'));
    }
    public function updatepoint(Request $request, $id)
    {
        $this->firebasePoint->updatePoint($request,$id);
        return redirect()->route('point')->with('success','data berhasil diupdate!');
    }
    public function deletepoint($id)
    {
        $this->firebasePoint->deletePoint($id);
        return redirect()->route('point')->with('success','data berhasil dihapus!');
    }


    public function indexMember(Request $request)
    {
         if($this->firebaseData->auth()['role'] == 'banksampah'){
            $search = null;
            if($request->has('search')){
               $search = $request->search;
            }
            $id = $this->firebaseData->auth()['banksampah_id'];
            $data = $this->firebasePoint->getAllPointMemberBank($id,$search);
        }else{
            $data = $this->firebasePoint->getAllPointMemberSelf($this->firebaseData->auth()['email']);
            $data[0]['id'] = $this->firebaseData->auth()['id'];
        }
       // return $data[0];
        $role = $this->firebaseData->auth()['role'];
        return view('pointdetail.point-detail', compact('data','role'));
    }
    
    public function laporan(Request $request)
    {
        // tolong ditambahkan untuk penjumlahan total point dan berat, terimakasih
        $search = null;
        if($request->has('search')){
           $search = $request->search;
        }
        $id = $this->firebaseData->auth()['banksampah_id'];
        $data = $this->firebasePoint->getAllPointMemberAll($id,$search);
        return view('banksampah.laporan', compact('data'));
    }

    public function getGurrentPointBankSampa(Request $request)
    {
        if($request->banksampah_id != null){
            if($request->berat != null && $request->jenis_sampah != NULL){
                $data =  $this->firebasePoint->getPointByBankSampahIdReal($request->banksampah_id,$request->jenis_sampah);
                if($data != null){
                    $berat = $request->berat;
                    $result = $data['harga'] * $berat;
                    return response()->json([
                        'status'=>'success',
                        'result'=>$result
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
                        'result'=>'berat & jenis_sampah is required!'
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
