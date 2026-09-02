<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AssessmentSection extends Model
{

    use HasFactory;


    protected $fillable = [

        'assessment_template_id',
        'nama_section',
        'urutan'

    ];



    public function template()
    {

        return $this->belongsTo(
            AssessmentTemplate::class,
            'assessment_template_id'
        );

    }



    public function criterias()
    {

        return $this->hasMany(
            Criteria::class
        );

    }


}