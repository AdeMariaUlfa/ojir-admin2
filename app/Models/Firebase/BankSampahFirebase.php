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

    public function showBankSampah($filter)
    {
        $data = $this->database->getReference('bank_sampahs')->getValue();
        $result = null;
        foreach ($data as $key => $value) {
            if($value['id'] == $filter){
                $result = $data[$value['id']];
                break;
            }
        }
        return $result;
    }
}