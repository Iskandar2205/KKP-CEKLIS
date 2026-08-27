<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{

    use HasFactory;



    protected $fillable = [

        'nama_produk',

        'jenis_produk',

    ];



    /*
    |--------------------------------------------------------------------------
    | Relasi ke Sample
    |--------------------------------------------------------------------------
    |
    | Satu produk dapat memiliki banyak sample
    |
    */

    public function samples()
    {

        return $this->hasMany(Sample::class);

    }


}