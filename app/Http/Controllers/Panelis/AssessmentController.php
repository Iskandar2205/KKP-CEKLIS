<?php

namespace App\Http\Controllers\Panelis;


use App\Http\Controllers\Controller;

use App\Models\TestSession;
use App\Models\Criteria;
use App\Models\Assessment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AssessmentController extends Controller
{


    /**
     * Form penilaian panelis
     */
    public function create(TestSession $testSession)
    {


        // Ambil semua kriteria penilaian

        $criteria = Criteria::all();



        return view(

            'panelis.assessments.create',

            compact(
                'testSession',
                'criteria'
            )

        );


    }







    /**
     * Simpan hasil penilaian
     */
    public function store(Request $request, TestSession $testSession)
    {


        $request->validate([


            'nilai'=>[

                'required',

                'array'

            ],


        ]);





        /*
        |--------------------------------------------------------------------------
        | Membuat Assessment
        |--------------------------------------------------------------------------
        */


        $assessment = Assessment::create([


            'test_session_id'=>$testSession->id,


            'user_id'=>Auth::id(),


            'status'=>'selesai',


        ]);







        /*
        |--------------------------------------------------------------------------
        | Simpan Detail Nilai
        |--------------------------------------------------------------------------
        */


        foreach($request->nilai as $criteria_id=>$nilai)
        {


            $assessment->details()->create([


                'criteria_id'=>$criteria_id,


                'nilai'=>$nilai,


            ]);


        }






        return redirect()

            ->route('panelis.dashboard')

            ->with(

                'success',

                'Penilaian berhasil disimpan'

            );


    }


}