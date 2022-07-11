<?php
namespace App\Models\Firebase;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class PointFirebase
{
	private $database;

    public function __construct()
    {
        $this->database = \App\Services\FirebaseService::connect();
    }

    public function getAllPoints()
    {
        $data = $this->database->getReference('points')->getValue();
        $result = [];
        $no = 0;
        foreach ($data as $key => $value) {
           $result[$no]['id'] = $key;
          // $result[$no]['jenis_sampah'] = $value['jenis_sampah'];
           $result[$no]['harga'] = $value['harga'];
           //$result[$no]['berat'] = $value['berat'];
          // $result[$no]['banksampah_id'] = $value['banksampah_id'];
          // $result[$no]['created_at'] = $value['created_at'];
            $no++;
        }
        return $result;
    }

    public function getPointByBankSampahIdUser($id)
    {
        $data = $this->database->getReference('points')->getValue();
        $result = [];
        foreach ($data as $key => $value) {
            $user = $this->hasOneUser($value['banksampah_id']);
            if($user != null){
                array_push($result, $value);
            }
        }
        return $result;
    }

     public function getPointByBankSampahIdReal($id,$berat)
    {
        $data = $this->database->getReference('points')->getValue();
        $sort = array_column($data, 'created_at');
        $result = [];
        $no = 0;
        foreach ($data as $key => $value) {
           if($id == $value['banksampah_id']){
               $result[$no]['id'] = $key;
               $result[$no]['banksampah_id'] = $value['banksampah_id'];
               $result[$no]['jenis_sampah'] = $value['jenis_sampah'];
               $result[$no]['harga'] = $value['harga'];
               $result[$no]['berat'] = $value['berat'];
               $result[$no]['point'] = $value['harga'] * $berat;
               $no++;
           }
        }
        return $result;
    }

    public function getPointById($id)
    {
        $data = $this->database->getReference('points')->getValue();
        $result = null;
        foreach ($data as $key => $value) {
            if($key == $id){
            $result =  [
                        'id'=> $key,
                        'jenis_sampah' => $value['jenis_sampah'],
                        'harga' => $value['harga'],
                        'berat' => $value['berat'],
                        'banksampah_id' => $value['banksampah_id'],
                        'created_at'=>$value['created_at'],
                    ]; 
                }
            }
        return $result;
    }

    public function hasOneUser($banksampah_id)
    {
        $data = $this->database->getReference('bank_sampahs')->getValue();
        $arr = null;
        foreach ($data as $key => $value) {
            if($key == $banksampah_id){
                $arr = $value;
            }
        }
         return $arr;
    }

    public function postpoint($data,$idbs)
    {
        $time = Carbon::now('Asia/Jakarta')->toDateTimeString();
        $id = strtotime($time) + 1;
        $this->database
        ->getReference('points/' . $id)
        ->set([
            'id'=> $id,
            'jenis_sampah' => $data->jenis_sampah,
            'harga' => $data->harga,
            'berat' => $data->berat,
            'banksampah_id' => $idbs,
            'created_at'=>$time
        ]);
        return $id;
    }

    public function updatePoint($data,$id)
    {
        $time = Carbon::now('Asia/Jakarta')->toDateTimeString();
        $this->database
        ->getReference('points/' . $id)
        ->update([
            'jenis_sampah' => $data->jenis_sampah,
            'harga' => $data->harga,
            'berat' => $data->berat,
            //'banksampah_id' => $banksampah_id,
            'created_at'=>$time
        ]);
        return $id;
    }

    public function deletePoint($id)
    {
         $this->database
        ->getReference('points/' . $id)
        ->remove();
    }
}