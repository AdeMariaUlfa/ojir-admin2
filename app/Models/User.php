<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the bank_sampah associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bank_sampah()
    {
        return $this->hasOne(BankSampah::class, 'user_id', 'id');
    }

    /**
     * Get the member associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne(Member::class, 'user_id', 'id');
    }

    public function isAdminBankSampah()
    {
        if($this->role == 'banksampah'){
            return true;
        }else{
            return false;
        }
    }
    public function isAdminKeuangan()
    {
        if($this->role == 'keuangan'){
            return true;
        }else{
            return false;
        }
    }
    public function isLocalHero()
    {
        if($this->role == 'localhero'){
            return true;
        }else{
            return false;
        }
    }
    public function isClient()
    {
        if($this->role == 'client'){
            return true;
        }else{
            return false;
        }
    }
    public function hasRole($role)
    {
       switch($role){
           case 'banksampah' : return \Auth::user()->isAdminBankSampah();
           case 'keuangan': return \Auth::user()->isAdminKeuangan();
           case 'localhero' : return \Auth::user()->isLocalHero();
           case 'client' : return \Auth::user()->isClient();
       }
       return false;
    }
}