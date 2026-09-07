<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AssessmentTemplate extends Model
{

    use HasFactory;


    protected $fillable = [

        'product_id',
        'nama_template',
        'file_template'

    ];



    public function product()
    {

        return $this->belongsTo(
            Product::class
        );

    }




    /*
    |--------------------------------------------------------------------------
    | Section Pengujian
    |--------------------------------------------------------------------------
    */

    public function sections()
    {

        return $this->hasMany(
            AssessmentSection::class,
            'assessment_template_id'
        );

    }



    /*
    |--------------------------------------------------------------------------
    | Alias agar bisa dipanggil assessmentSections
    |--------------------------------------------------------------------------
    */

    public function assessmentSections()
    {

        return $this->hasMany(
            AssessmentSection::class,
            'assessment_template_id'
        );

    }




    /*
    |--------------------------------------------------------------------------
    | Semua parameter penilaian
    |--------------------------------------------------------------------------
    */

    public function criterias()
    {

        return $this->hasManyThrough(

            Criteria::class,

            AssessmentSection::class,

            'assessment_template_id', // FK di assessment_sections

            'assessment_section_id',  // FK di criteria

            'id',                     // PK assessment_templates

            'id'                      // PK assessment_sections

        );

    }


}