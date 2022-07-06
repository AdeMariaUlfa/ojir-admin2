<?php
namespace App\Models\Firebase;
use Illuminate\Support\Facades\Hash;
use Session;
class FirebaseData
{
	public function auth()
	{
		return Session::get('dataUser');
	}
}