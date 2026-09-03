<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentDetail extends Model
{

    protected $fillable = [

        'assessment_id',
        'criteria_id',
        'nilai'

    ];



    public function assessment()
    {

        return $this->belongsTo(
            Assessment::class
        );

    }



    public function criteria()
    {

        return $this->belongsTo(
            Criteria::class
        );

    }

}