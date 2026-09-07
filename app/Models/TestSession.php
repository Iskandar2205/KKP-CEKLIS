<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class TestSession extends Model
{

    use HasFactory;


    protected $fillable = [

    'sample_id',

    'assessment_template_id',

    'tanggal_pengujian',

    'status',

    'catatan',

 ];



    public function sample()
    {
        return $this->belongsTo(
            Sample::class
        );
    }
   public function assessmentTemplate()
{
    return $this->belongsTo(
        AssessmentTemplate::class,
        'assessment_template_id'
    );
}
    public function assessments()
    {
        return $this->hasMany(
            Assessment::class
        );
    }



    public function sessionUsers()
    {

        return $this->hasMany(SessionUser::class);
    }

    public function testResult()
    {

        return $this->hasOne(
            TestResult::class
        );
    }
}
