<?php
namespace App\Models\Firebase;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class UserFirebase
{
	private $database;

    public function __construct()
    {
        $this->database = \App\Services\FirebaseService::connect();
    }

    public function loginFirebase($email)
    {
        $data = $this->database->getReference('users')->getValue();
        //return $data;
        $result = [];
        foreach ($data as $key => $value) {
            if($value['email'] == $email){
                $result['id'] = $key;
                $result['email'] = $value['email'];
                $result['name'] = $value['name'];
                $result['password'] = $value['password'];
                $result['role'] = $value['role'];
                $result['status'] = $value['status'];
                if($value['role'] == 'banksampah'){
                    $user = $this->hasOneUser($key);
                    if($user != null){
                        $result['pemilik'] = $user['pemilik'];
                        $result['tanggal_berdiri'] = $user['tanggal_berdiri'];
                        $result['alamat_banksampah'] = $user['alamat_banksampah'];
                        $result['kota_kab'] = $user['kota_kab'];
                        $result['phone'] = $user['phone'];
                    }
                }
                break;
            }
        }
        return $result;
    }

    public function hasOneUser($user_id)
    {
        $data = $this->database->getReference('bank_sampahs')->getValue();
        $arr = null;
        foreach ($data as $key => $value) {
            if($value['user_id'] == $user_id){
                $arr = $value;
            }
        }
         return $arr;
    }

    public function createUser($data)
    {
    	$time = Carbon::now('Asia/Jakarta')->toDateTimeString();
    	$id = strtotime($time) + 1;
    	$this->database
        ->getReference('users/' . $id)
        ->set([
        	'id'=> $id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'banksampah',
            'status' => 'no',
        ]);

        return $id;
    }

    public function createBankSampahUser($data,$user_id)
    {
    	$time = Carbon::now('Asia/Jakarta')->toDateTimeString();
    	$id = strtotime($time) + 1;
    	$this->database
        ->getReference('bank_sampahs/' . $id)
        ->set([
            'id'=>$id,
        	'user_id' => $user_id,
            'pemilik' => $data['pemilik'],
            'tanggal_berdiri' => $data['tanggal_berdiri'],
            'alamat_banksampah' => $data['alamat_banksampah'],
            'kota_kab' => $data['kota_kab'],
            'phone' => $data['phone'],
        ]);

        return $id;
    }

    public function createMember($data)
    {
    	$time = Carbon::now('Asia/Jakarta')->toDateTimeString();
    	$id = strtotime($time) + 1;
    	$this->database
        ->getReference('users/' . $id)
        ->set([
        	'id'=> $id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'status' => 'yes',
        ]);

        return $id;
    }

    public function createBankSampahMember($data,$user_id)
    {
    	$time = Carbon::now('Asia/Jakarta')->toDateTimeString();
    	$id = strtotime($time) + 1;
    	$this->database
        ->getReference('members/' . $id)
        ->set([
            'id'=> $id,
        	'banksampah_id' => $data['banksampah'],
            'user_id' => $user_id,
            'no_ktp' => $data['no_ktp'],
            'gender' => $data['gender'],
            'alamat' => $data['alamat'],
            'no_telp' => $data['no_telp'],
            'upload_ktp' => url('/').'/'.$data['path']
        ]);

        return $id;
    }
}