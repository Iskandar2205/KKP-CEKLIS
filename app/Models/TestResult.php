<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TestResult extends Model
{


    protected $fillable = [

        'test_session_id',

        'jumlah_panelis',

        'jumlah_parameter',

        'total_nilai',

        'rata_rata_produk',

        'z_score',

        'akar_n',

        'varians',

        'standar_deviasi',

        'error',

        'p_min',

        'p_max',

        'nilai_mutu',

        'kategori'

    ];



    public function testSession()
    {

        return $this->belongsTo(
            TestSession::class
        );
    }
}
