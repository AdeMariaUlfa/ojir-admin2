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
           $result[$no]['harga'] = $value['harga'];
           $no++;
        }
        return $result;
    }

    public function getAllPointMemberSelf($email)
    {
        $data = $this->database->getReference('users')->getValue();
        $result = [];
        $point = 0;
        $id = 0;
        $name = '';
        $phone = '';
        foreach ($data as $key => $value) {
            if(isset($value['poin'])){
                if($value['email'] == $email)
                {
                    $phone = $value['phone'];
                    $name = $value['name'];
                    $point += $value['poin'];
                }
            }
        }
        $result['id'] =$id;
        $result['phone'] =$phone;
        $result['name'] = $name;
        $result['point'] = $point;
        return $result;
    }

    public function getAllPointMemberAll($banksampah_id)
    {
        $data = $this->database->getReference('users')->getValue();
        $result = [];
        $no = 0;
        foreach ($data as $key => $value) {
            $bank = $this->hasOneUserMember($key);
            if($bank != null){
                if($bank['banksampah_id'] == $banksampah_id){
                    $self = $this->getAllPointMemberSelf($value['email']);
                    $result[$no]['id'] = $key;
                    $result[$no]['role'] = $value['role'];
                    $result[$no]['name'] = $self['name'];
                    $result[$no]['phone'] = $self['phone'];
                    $result[$no]['point'] = $self['point'];
                    $no++;
                }
            }
        }
        return $result;
    }

    public function hasOneUserMember($user_id)
    {
        $data = $this->database->getReference('members')->getValue();
        $arr = null;
        foreach ($data as $key => $value) {
            if($key == $user_id){
                $arr = $value;
            }
        }
         return $arr;
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

     public function getPointByBankSampahIdReal($id,$jenis_sampah)
    {
        $data = $this->database->getReference('points')->getValue();
        //$sort = array_column($data, 'created_at');
        $result = null;
        foreach ($data as $key => $value) {
           if($id == $value['banksampah_id'] && $jenis_sampah == $value['jenis_sampah']){
              $result = $value;
              break;
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