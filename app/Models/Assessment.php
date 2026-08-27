<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Assessment extends Model
{

    use HasFactory;


    protected $fillable = [

        'test_session_id',
        'user_id',
        'status',

    ];



    public function testSession()
    {

        return $this->belongsTo(TestSession::class);

    }



    public function user()
    {

        return $this->belongsTo(User::class);

    }



    public function details()
    {

        return $this->hasMany(AssessmentDetail::class);

    }


}