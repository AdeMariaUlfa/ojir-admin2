<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'no_ktp', 'upload_ktp', 'gender', 'alamat', 'no_telp', 'banksampah_id'];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
