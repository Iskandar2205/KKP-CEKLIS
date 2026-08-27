<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class CriteriaOption extends Model
{

    use HasFactory;


    protected $fillable = [

        'nilai',

        'deskripsi'

    ];

}