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

        return $this->belongsTo(Product::class);

    }



    public function sections()
    {

        return $this->hasMany(
            AssessmentSection::class
        );

    }


}