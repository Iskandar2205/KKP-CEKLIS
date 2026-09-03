<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{

    protected $fillable = [

        'test_session_id',
        'user_id',
        'total_nilai',
        'nilai_akhir',
        'status'

    ];



    public function testSession()
    {

        return $this->belongsTo(
            TestSession::class
        );

    }



    public function user()
    {

        return $this->belongsTo(
            User::class
        );

    }



    public function details()
    {

        return $this->hasMany(
            AssessmentDetail::class
        );

    }


}