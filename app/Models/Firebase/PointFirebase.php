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
        $result[0]['id'] =$id;
        $result[0]['phone'] =$phone;
        $result[0]['name'] = $name;
        $result[0]['point'] = $point;
        return $result;
    }

    public function getAllPointMemberBank($banksampah_id,$search=null)
    {
        $data = $this->database->getReference('users')->getValue();
        $result = [];
        $no = 0;
        foreach ($data as $key => $value) {
            $member = $this->hasOneUserMember($key);
            if($member != null){
                if($member['banksampah_id'] == $banksampah_id){
                     $self = $this->getAllPointMemberSelf($value['email']);
                     if($search!=null){
                        $lws = strtolower(str_replace(' ', '', $search));
                        $lwk = strtolower(str_replace(' ', '', $self[0]['name']));
                        if($lws == $lwk){
                             $result[$no]['id'] = $key;
                             $result[$no]['name'] = $self[0]['name'];
                             $result[$no]['phone'] = $self[0]['phone'];
                             $result[$no]['point'] = $self[0]['point'];
                             $no++;
                        }
                    }else{
                         $result[$no]['id'] = $key;
                         $result[$no]['name'] = $self[0]['name'];
                         $result[$no]['phone'] = $self[0]['phone'];
                         $result[$no]['point'] = $self[0]['point'];
                         $no++;
                    }
                }
            }
        }
        return $result;
    }

    public function getAllPointMemberAll($banksampah_id,$search=null)
    {
        $data = $this->database->getReference('users')->getValue();
        $result = [];
        $no = 0;
        foreach ($data as $key => $value) {
            $bank = $this->hasOneUserMember($key);
            if($bank != null){
                if($bank['banksampah_id'] == $banksampah_id){
                    $self = $this->getAllPointMemberSelf($value['email']);
                    if($search!=null){
                        $lws = strtolower(str_replace(' ', '', $search));
                        $lwk = strtolower(str_replace(' ', '', $self[0]['name']));
                        if($lws == $lwk){
                            $result[$no]['id'] = $key;
                            $result[$no]['role'] = $value['role'];
                            $result[$no]['name'] = $self[0]['name'] ?? 'none';
                            $result[$no]['phone'] = $self[0]['phone'] ?? 'none';
                            $result[$no]['point'] = $self[0]['point'] ?? 0;
                            $no++;
                        }
                    }else{
                        $result[$no]['id'] = $key;
                        $result[$no]['role'] = $value['role'];
                        $result[$no]['name'] = $self['name'] ?? 'none';
                        $result[$no]['phone'] = $self['phone'] ?? 'none';
                        $result[$no]['point'] = $self['point'] ?? 0;
                        $no++;
                    }
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

    public function getPointByBankSampahIdUser($id,$search)
    {
        $data = $this->database->getReference('points')->getValue();
        $result = [];
        foreach ($data as $key => $value) {
            $user = $this->hasOneUser($value['banksampah_id']);
            if($user != null){
                if($search != null){
                    $lws = strtolower(str_replace(' ', '', $search));
                    $lwk = strtolower(str_replace(' ', '', $value['jenis_sampah']));
                    if($lws == $lwk){
                        array_push($result, $value);
                    }
                }else{
                    array_push($result, $value);
                }
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