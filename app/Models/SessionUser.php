<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class SessionUser extends Model
{

    use HasFactory;



    protected $fillable = [


        'test_session_id',


        'nama',


        'user_id',


        'role',


    ];







    /*
    |--------------------------------------------------------------------------
    | Relasi ke Test Session
    |--------------------------------------------------------------------------
    */

    public function testSession()
    {

        return $this->belongsTo(TestSession::class);

    }







    /*
    |--------------------------------------------------------------------------
    | Relasi ke User (opsional)
    |--------------------------------------------------------------------------
    |
    | Dipakai untuk penyelia yang memiliki akun.
    | Panelis manual tidak menggunakan relasi ini.
    |
    */

    public function user()
    {

        return $this->belongsTo(User::class);

    }



}   