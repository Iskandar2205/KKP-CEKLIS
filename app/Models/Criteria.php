<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{

    protected $table = 'criteria';


    protected $fillable = [

        'assessment_section_id',
        'nama_kriteria',
        'tahap',
        'urutan'

    ];



    public function assessmentSection()
    {
        return $this->belongsTo(
            AssessmentSection::class,
            'assessment_section_id'
        );
    }



    public function options()
    {
        return $this->hasMany(
            CriteriaOption::class,
            'criteria_id'
        );
    }

}