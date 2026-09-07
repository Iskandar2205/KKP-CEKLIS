<?php

namespace App\Http\Controllers\Panelis;

use App\Http\Controllers\Controller;
use App\Models\TestSession;
use App\Models\Assessment;
use App\Models\AssessmentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AssessmentController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | Form Penilaian Panelis
    |--------------------------------------------------------------------------
    */

public function create(TestSession $testSession)
{

    $testSession->load([

        'assessmentTemplate.sections.criterias.options',
        'sample.product'

    ]);



    $template = $testSession->assessmentTemplate;



    return view(
        'panelis.assessments.create',
        compact(
            'testSession',
            'template'
        )
    );

}






    /*
    |--------------------------------------------------------------------------
    | Simpan Penilaian
    |--------------------------------------------------------------------------
    */


    public function store(
        Request $request,
        TestSession $testSession
    )
    {


        $request->validate([

            'nilai'=>[
                'required',
                'array'
            ]

        ]);




        $assessment = Assessment::create([

            'test_session_id'=>$testSession->id,

            'user_id'=>Auth::id(),

            'status'=>'selesai'

        ]);





        $total = 0;



        foreach($request->nilai as $criteriaId=>$nilai)
        {


            AssessmentDetail::create([

                'assessment_id'=>$assessment->id,

                'criteria_id'=>$criteriaId,

                'nilai'=>$nilai

            ]);


            $total += $nilai;


        }




        $jumlah = count($request->nilai);



        $assessment->update([

            'total_nilai'=>$total,

            'nilai_akhir'=>round(
                $total/$jumlah,
                2
            )

        ]);




        return redirect()

            ->route(
                'panelis.dashboard'
            )

            ->with(
                'success',
                'Penilaian berhasil disimpan'
            );


    }


}