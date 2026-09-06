<?php

namespace App\Http\Controllers\Pimpinan;


use App\Http\Controllers\Controller;
use App\Models\TestSession;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TestSessionExport;
use Maatwebsite\Excel\Facades\Excel;



class TestSessionController extends Controller
{


    /**
     * Detail hasil pengujian pimpinan
     */
    public function show(TestSession $testSession)
    {


        $testSession->load([

            'sample.product',

            'assessments.user',

            'assessments.details.criteria'

        ]);



        $totalNilai = 0;


        foreach($testSession->assessments as $assessment)
        {

            $totalNilai += $assessment->total_nilai;

        }



        $jumlahPanelis = $testSession
            ->assessments
            ->count();



        if($jumlahPanelis > 0)
        {

            $nilaiMutu = $totalNilai / ($jumlahPanelis * 4);

        }
        else
        {

            $nilaiMutu = 0;

        }



        return view(

            'pimpinan.test_sessions.show',

            compact(

                'testSession',
                'nilaiMutu',
                'jumlahPanelis'

            )

        );


    }








    /**
     * Download PDF Pimpinan
     */
    public function pdf(TestSession $testSession)
    {


        $testSession->load([

            'sample.product',

            'assessments.user',

            'assessments.details.criteria'

        ]);



        $pdf = Pdf::loadView(

            'admin.test_sessions.pdf',

            compact('testSession')

        );



        $pdf->setPaper(

            'a4',

            'landscape'

        );



        return $pdf->download(

            'Hasil_Uji_' .
            $testSession->sample->nomor_sample .
            '.pdf'

        );


    }








    /**
     * Download Excel Pimpinan
     */
    public function excel(TestSession $testSession)
    {


        return Excel::download(

            new TestSessionExport($testSession->id),

            'Hasil_Uji_' .
            $testSession->sample->nomor_sample .
            '.xlsx'

        );


    }



}