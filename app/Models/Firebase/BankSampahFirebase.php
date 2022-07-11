<?php
namespace App\Models\Firebase;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class BankSampahFirebase
{
	private $database;

    public function __construct()
    {
        $this->database = \App\Services\FirebaseService::connect();
    }

    public function getAll()
    {
        $data = $this->database->getReference('bank_sampahs')->getValue();
        $result = [];
        $no = 0;
        foreach ($data as $key => $value) {
            $user = $this->hasOneUser($value['user_id']);
            $name = '-';
            $email = '-';
            $status = '-';
            if($user['status'] == true){
                $name = $user['data']['name'];
                $email = $user['data']['email'];
                $status = $user['data']['status'];
            }
            $result[$no]['id'] = $key;
            $result[$no]['name'] = $name;
            $result[$no]['email'] = $email;
            $result[$no]['status'] = $status;
            $result[$no]['user_id'] = $value['user_id'];
            $result[$no]['pemilik'] = $value['pemilik'];
            $result[$no]['tanggal_berdiri'] = $value['tanggal_berdiri'];
            $result[$no]['alamat_banksampah'] = $value['alamat_banksampah'];
            $result[$no]['kota_kab'] = $value['kota_kab'];
            $result[$no]['phone'] = $value['phone'];
            $no++;
        }
        return $result;
    }

    public function getByUserId($id)
    {
        $data = $this->database->getReference('bank_sampahs')->getValue();
       // return $data;
        $result = [];
        foreach ($data as $key => $value) {
            if($value['user_id'] == $id){
                $result['id'] = $key;
                $result['pemilik'] = $value['pemilik'];
                $result['tanggal_berdiri'] = $value['tanggal_berdiri'];
                $result['alamat_banksampah'] = $value['alamat_banksampah'];
                $result['kota_kab'] = $value['kota_kab'];
                $result['phone'] = $value['phone'];
                break;
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
        $data = $this->database->getReference('bank_sampahs')->getValue();
        $result = null;
        foreach ($data as $key => $value) {
            if($filter == $key){
                $result = $data[$key];
                break;
            }
        }
        return $result;
    }

    public function search($pemilik,$paginate)
    {
        $data = $this->database->getReference('bank_sampahs')->getValue();
        $result = [];
        $no = 0;
        foreach ($data as $key => $value) {
            $strsp = str_replace(' ', '', $pemilik);
            $low = strtolower($strsp);
            if(stripos($value['pemilik'], $low) !== FALSE){
                $user = $this->hasOneUser($value['user_id']);
                $name = '-';
                $email = '-';
                $status = '-';
                if($user['status'] == true){
                    $name = $user['data']['name'];
                    $email = $user['data']['email'];
                    $status = $user['data']['status'];
                }
                $result[$no]['name'] = $name;
                $result[$no]['email'] = $email;
                $result[$no]['status'] = $status;
                $result[$no]['user_id'] = $value['user_id'];
                $result[$no]['pemilik'] = $value['pemilik'];
                $result[$no]['tanggal_berdiri'] = $value['tanggal_berdiri'];
                $result[$no]['alamat_banksampah'] = $value['alamat_banksampah'];
                $result[$no]['kota_kab'] = $value['kota_kab'];
                $result[$no]['phone'] = $value['phone'];
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

}