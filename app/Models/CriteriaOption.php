<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriteriaOption extends Model
{

    protected $table = 'criteria_options';


    protected $fillable = [

        'criteria_id',
        'nilai',
        'deskripsi'

    ];



    public function criteria()
    {

        return $this->belongsTo(
            Criteria::class,
            'criteria_id'
        );

    }

}