<?php
namespace App\Models\Firebase;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class MemberFirebase
{
	private $database;

    public function __construct()
    {
        $this->database = \App\Services\FirebaseService::connect();
    }

    public function getAll()
    {
        $data = $this->database->getReference('members')->getValue();
        $result = [];
        $no = 0;
        foreach ($data as $key => $value) {
            $user = $this->hasOneUser($value['user_id']);
            $name = '-';
            $email = '-';
            $role = '-';
            $status = '-';
            if($user['status'] == true){
                $name = $user['data']['name'];
                $email = $user['data']['email'];
                $status = $user['data']['status'];
                $role = $user['data']['role'];
            }
            $result[$no]['name'] = $name;
            $result[$no]['email'] = $email;
            $result[$no]['status'] = $status;
            $result[$no]['role'] = $role;
            $result[$no]['user_id'] = $value['user_id'];
            $result[$no]['gender'] = $value['gender'];
            $result[$no]['no_ktp'] = $value['no_ktp'];
            $result[$no]['alamat'] = $value['alamat'];
            $result[$no]['no_telp'] = $value['no_telp'];
            $result[$no]['upload_ktp'] = $value['upload_ktp'];
            $result[$no]['banksampah_id'] = $value['banksampah_id'];
            $no++;
        }
        return $result;
    }

    public function getAllByBankSampa($id)
    {
        $data = $this->database->getReference('members')->getValue();
        $result = [];
        $no = 0;
        foreach ($data as $key => $value) {
            if($value['banksampah_id'] == $id){
                $user = $this->hasOneUser($value['user_id']);
                $name = '-';
                $email = '-';
                $role = '-';
                $status = '-';
                if($user['status'] == true){
                    $name = $user['data']['name'];
                    $email = $user['data']['email'];
                    $status = $user['data']['status'];
                    $role = $user['data']['role'];
                }
                $result[$no]['name'] = $name;
                $result[$no]['email'] = $email;
                $result[$no]['status'] = $status;
                $result[$no]['role'] = $role;
                $result[$no]['user_id'] = $value['user_id'];
                $result[$no]['gender'] = $value['gender'];
                $result[$no]['no_ktp'] = $value['no_ktp'];
                $result[$no]['alamat'] = $value['alamat'];
                $result[$no]['no_telp'] = $value['no_telp'];
                $result[$no]['upload_ktp'] = $value['upload_ktp'];
                $result[$no]['banksampah_id'] = $value['banksampah_id'];
                $no++;
            }
        }
        return $result;
    }

    public function hasOneUser($user_id)
    {
        $data = $this->database->getReference('users')->getValue();
        $arr = [];
        if(isset($data[$user_id]))
        {
            $arr['status'] = true;
            $arr['data'] = $data[$user_id];
        }else{
            $arr['status'] = false;
            $arr['data'] = [];
        }
         return $arr;
    }

    public function showBankSampah($filter)
    {
        $data = $this->database->getReference('members')->getValue();
        $result = null;
        foreach ($data as $key => $value) {
            if($value['id'] == $filter){
                $result = $data[$value['id']];
                break;
            }
        }
        return $result;
    }

    public function search($gender,$paginate)
    {
        $data = $this->database->getReference('members')->getValue();
        $result = [];
        $no = 0;
        foreach ($data as $key => $value) {
            $strsp = str_replace(' ', '', $gender);
            $low = strtolower($strsp);
            if(stripos($value['gender'], $low) !== FALSE){
                $user = $this->hasOneUser($value['user_id']);
                $name = '-';
                $email = '-';
                $role = '-';
                $status = '-';
                if($user['status'] == true){
                    $name = $user['data']['name'];
                    $email = $user['data']['email'];
                    $status = $user['data']['status'];
                    $role = $user['data']['role'];
                }
                $result[$no]['name'] = $name;
                $result[$no]['email'] = $email;
                $result[$no]['status'] = $status;
                $result[$no]['role'] = $role;
                $result[$no]['user_id'] = $value['user_id'];
                $result[$no]['gender'] = $value['gender'];
                $result[$no]['no_ktp'] = $value['no_ktp'];
                $result[$no]['alamat'] = $value['alamat'];
                $result[$no]['no_telp'] = $value['no_telp'];
                $result[$no]['upload_ktp'] = $value['upload_ktp'];
                $result[$no]['banksampah_id'] = $value['banksampah_id'];
            if($no <= $paginate){
                break;
            }
                $no++;
            }
        }
        return $result;
    }

    public function updateOrReject($user_id,$status)
    {
        $this->database
        ->getReference('users/' . $user_id)
        ->update([
            'status'=>$status,
        ]);
    }

    public function getDriver()
    {
        $data = $this->database->getReference('drivers')->getValue();
        $result = [];
        $no = 0;
        foreach ($data as $key => $value) {
           // $user = $this->hasOneUser($value['user_id']);
            // $name = '-';
            // $email = '-';
            // $role = '-';
            // $status = '-';
            // if($user['status'] == true){
            //     $name = $user['data']['name'];
            //     $email = $user['data']['email'];
            //     $status = $user['data']['status'];
            //     $role = $user['data']['role'];
            // }
            // $result[$no]['name'] = $name;
            // $result[$no]['email'] = $email;
            // $result[$no]['status'] = $status;
            // $result[$no]['role'] = $role;
            //$result[$no]['user_id'] = $value['email'];
            $result[$no]['id'] = $key;
            $result[$no]['email'] = $value['email'] ?? '-';
            $result[$no]['name'] = $value['name'] ?? '-';
            $result[$no]['phone'] = $value['phone'] ?? '-';
            $result[$no]['photo'] = $value['photo'] ?? '-';
           // $result[$no]['upload_ktp'] = $value['upload_ktp'];

            $no++;
        }
        return $result;
    }

    public function getByBankSampahId($banksampah_id)
    {
        $data = $this->database->getReference('members')->getValue();
        $result = [];
        $no = 0;
        foreach ($data as $key => $value) {
            $user = $this->hasOneUser($value['user_id']);
            if($value['banksampah_id'] == $banksampah_id && $user['data']['role'] == 'client'){
                $name = '-';
                $email = '-';
                $role = '-';
                $status = '-';
                if($user['status'] == true){
                    $name = $user['data']['name'];
                    $email = $user['data']['email'];
                    $status = $user['data']['status'];
                    $role = $user['data']['role'];
                }
                $result[$no]['id'] = $key;
                $result[$no]['name'] = $name;
                $result[$no]['email'] = $email;
                $result[$no]['status'] = $status;
                $result[$no]['role'] = $role;
                $result[$no]['user_id'] = $value['user_id'];
                $result[$no]['gender'] = $value['gender'];
                $result[$no]['no_ktp'] = $value['no_ktp'];
                $result[$no]['alamat'] = $value['alamat'];
                $result[$no]['no_telp'] = $value['no_telp'];
                $result[$no]['upload_ktp'] = $value['upload_ktp'];
                $result[$no]['banksampah_id'] = $value['banksampah_id'];
                $no++;
            }
        }
        return $result;
    }

}