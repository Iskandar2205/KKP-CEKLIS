<?php

namespace App\Exports;


use App\Models\TestSession;

use Maatwebsite\Excel\Concerns\FromView;

use Illuminate\Contracts\View\View;



class TestSessionExport implements FromView
{


    protected $testSessionId;



    public function __construct($testSessionId)
    {

        $this->testSessionId = $testSessionId;

    }





    public function view(): View
    {


        $testSession = TestSession::with([

            'sample.product',

            'assessments.user',

            'assessments.details.criteria'


        ])
        ->findOrFail($this->testSessionId);




        return view(

            'pimpinan.test_sessions.excel',

            compact('testSession')

        );


    }



}