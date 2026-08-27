<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Sample extends Model
{

    use HasFactory;




    protected $fillable = [

        'product_id',

        'nomor_sample',

        'kode_sample',

        'tanggal',

    ];





    /*
    |--------------------------------------------------------------------------
    | Relasi ke Product
    |--------------------------------------------------------------------------
    */


    public function product()
    {

        return $this->belongsTo(Product::class);

    }






    /*
    |--------------------------------------------------------------------------
    | Relasi ke Test Session
    |--------------------------------------------------------------------------
    |
    | Satu sample dapat digunakan beberapa kali pengujian
    |
    */


    public function testSessions()
    {

        return $this->hasMany(TestSession::class);

    }



}