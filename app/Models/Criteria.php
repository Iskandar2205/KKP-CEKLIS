<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Criteria extends Model
{

    use HasFactory;



    protected $fillable = [

        'nama_kriteria',

    ];



    public function assessmentDetails()
    {

        return $this->hasMany(
            AssessmentDetail::class
        );

    }


}