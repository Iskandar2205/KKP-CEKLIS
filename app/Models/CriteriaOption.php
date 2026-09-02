<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CriteriaOption extends Model
{

    use HasFactory;


    protected $fillable = [

        'criteria_id',
        'nilai',
        'deskripsi'

    ];



    /**
     * Relasi ke kriteria
     */
    public function criteria()
    {

        return $this->belongsTo(Criteria::class, 'criteria_id');

    }


}