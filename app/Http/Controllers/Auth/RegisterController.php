<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\BankSampah;
use App\Models\Member;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::LOGIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'pemilik' => ['required', 'max:255'],
            'tanggal_berdiri' => ['required'],
            'alamat_banksampah' => ['required', 'max:255'],
            'kota_kab' => ['required', 'max:255'],
            'phone' => ['required', 'numeric', 'unique:bank_sampahs'],
        ]);
    }

    protected function validatorMember(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_ktp' => ['required', 'string'],
            'upload_ktp' => ['required'],
            'gender' => ['required'],
            'alamat' => ['required', 'string'],
            'no_telp' => ['required', 'numeric', 'unique:members'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'banksampah',
            'status' => 'no',
        ]);

        BankSampah::create([
            'user_id' => $user->id,
            'pemilik' => $data['pemilik'],
            'tanggal_berdiri' => $data['tanggal_berdiri'],
            'alamat_banksampah' => $data['alamat_banksampah'],
            'kota_kab' => $data['kota_kab'],
            'phone' => $data['phone'],
        ]);

        return $user;
    }

    protected function createMember(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'status' => 'yes',
        ]);

        $path = request()->file('upload_ktp') ?? null;
        if (request()->hasFile('upload_ktp'))
        {
            $file = request()->file('upload_ktp');
            $name = time();
            $extension = $file->getClientOriginalExtension();
            $fileName = $name . '.' . $extension;
            $path = $file->move('foto_ktp_member/', $file->getClientOriginalName());
        }
        Member::create([
            'banksampah_id' => $data['banksampah'],
            'user_id' => $user->id,
            'no_ktp' => $data['no_ktp'],
            'gender' => $data['gender'],
            'alamat' => $data['alamat'],
            'no_telp' => $data['no_telp'],
            'upload_ktp' => $path
        ]);


        return $user;
    }

    public function showBankSampah(Request $request)
    {
        $data = BankSampah::where('id', $request->filter)->first();
        return $data;
    }
}
