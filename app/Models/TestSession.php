<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class TestSession extends Model
{

    use HasFactory;



    protected $fillable = [

        'sample_id',

        'tanggal_pengujian',

        'status',

        'catatan',

    ];




    public function sample()
    {

        return $this->belongsTo(Sample::class);

    }




    public function sessionUsers()
    {

        return $this->hasMany(SessionUser::class);

    }


}