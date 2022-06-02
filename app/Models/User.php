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
}