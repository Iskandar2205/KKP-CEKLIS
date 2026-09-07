<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TestSession;
use App\Models\Sample;
use App\Models\User;
use App\Models\AssessmentTemplate;
use App\Models\TestResult;
use App\Models\SessionUser;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;



class TestSessionController extends Controller
{


    public function index()
    {


    $sessions = TestSession::with([
    'sample.product',
    'assessmentTemplate',
    'sessionUsers.user'
])
->latest()
->get();



        return view(
            'admin.test_sessions.index',
            compact('sessions')
        );
    }







  public function create()
{
    $samples = Sample::with('product')->get();

    $templates = AssessmentTemplate::all();

    $panelis = User::where('role', 'panelis')
        ->where('status', 'aktif')
        ->get();

    $penyelia = User::where('role', 'penyelia')
        ->where('status', 'aktif')
        ->get();

    return view(
        'admin.test_sessions.create',
        compact(
            'samples',
            'templates',
            'panelis',
            'penyelia'
        )
    );
}

 public function store(Request $request)
{


    $validated = $request->validate([


        'sample_id' => [
            'required',
            'exists:samples,id'
        ],


        'assessment_template_id' => [
            'required',
            'exists:assessment_templates,id'
        ],


        'tanggal_pengujian' => [
            'required',
            'date'
        ],


        'status' => [
            'required',
            'in:draft,dibuka,selesai'
        ],


        'catatan' => [
            'nullable',
            'string'
        ],


        'panelis' => [
            'required',
            'array'
        ],


        'panelis.*' => [
            'nullable',
            'exists:users,id'
        ],


        'penyelia' => [
            'nullable',
            'exists:users,id'
        ],


    ]);








    /*
    |--------------------------------------------------------------------------
    | Simpan Test Session
    |--------------------------------------------------------------------------
    */


    $session = TestSession::create([


        'sample_id'
            =>
        $request->sample_id,


        'assessment_template_id'
            =>
        $request->assessment_template_id,


        'tanggal_pengujian'
            =>
        $request->tanggal_pengujian,


        'status'
            =>
        $request->status,


        'catatan'
            =>
        $request->catatan,


    ]);









    /*
    |--------------------------------------------------------------------------
    | Simpan Panelis
    |--------------------------------------------------------------------------
    */


    foreach($request->panelis as $panelisId)
    {


        if($panelisId)
        {


            $user = User::find($panelisId);



            SessionUser::create([


                'test_session_id'
                    =>
                $session->id,


                'user_id'
                    =>
                $panelisId,


                'nama'
                    =>
                $user->name,


                'role'
                    =>
                'panelis'


            ]);


        }


    }









    /*
    |--------------------------------------------------------------------------
    | Simpan Penyelia
    |--------------------------------------------------------------------------
    */


    if($request->penyelia)
    {


        $user = User::find($request->penyelia);



        SessionUser::create([


            'test_session_id'
                =>
            $session->id,


            'user_id'
                =>
            $request->penyelia,


            'nama'
                =>
            $user->name,


            'role'
                =>
            'penyelia'


        ]);

    }









    return redirect()

        ->route('admin.test_sessions.index')

        ->with(
            'success',
            'Sesi pengujian berhasil dibuat'
        );

}







    public function show(TestSession $testSession)
    {


        $testSession->load([

            'sample.product',

            'sessionUsers.user'

        ]);




        return view(

            'admin.test_sessions.show',

            compact('testSession')

        );
    }









    public function edit(TestSession $testSession)
    {


        $samples = Sample::with('product')
            ->get();



        $panelis = User::where('role', 'panelis')
            ->where('status', 'aktif')
            ->get();



        $penyelia = User::where('role', 'penyelia')
            ->where('status', 'aktif')
            ->get();



        return view(

            'admin.test_sessions.edit',

            compact(

                'testSession',

                'samples',

                'panelis',

                'penyelia'

            )

        );
    }









    public function update(Request $request, TestSession $testSession)
    {


        $validated = $request->validate([


            'sample_id' => [
                'required',
                'exists:samples,id'
            ],


            'tanggal_pengujian' => [
                'required',
                'date'
            ],


            'status' => [
                'required',
                'in:draft,dibuka,selesai'
            ],


            'catatan' => [
                'nullable',
                'string'
            ],

        ]);





        /*
        Update template jika sample berubah
        */


        $sample = Sample::findOrFail(
            $request->sample_id
        );


        $template = AssessmentTemplate::where(
            'product_id',
            $sample->product_id
        )
        ->first();



        $validated['assessment_template_id'] =
            $template?->id;





        $testSession->update($validated);





        return redirect()

            ->route('admin.test_sessions.index')

            ->with(
                'success',
                'Sesi berhasil diperbarui'
            );
    }









    public function open(TestSession $testSession)
    {


        $testSession->update([

            'status' => 'dibuka'

        ]);



        return redirect()

            ->route('admin.test_sessions.index')

            ->with(
                'success',
                'Sesi berhasil dibuka'
            );
    }









    public function finish(TestSession $testSession)
    {


        $testSession->update([

            'status' => 'selesai'

        ]);



        return redirect()

            ->route('admin.test_sessions.index')

            ->with(
                'success',
                'Sesi berhasil diselesaikan'
            );
    }


 public function results(TestSession $testSession)
{


    $testSession->load([


        'sample.product',


        'assessmentTemplate.criterias',


        'assessments.user',


        'assessments.details.criteria',


        'testResult'


    ]);





    /*
    |--------------------------------------------------------------------------
    | Ambil parameter sesuai dataset/template aktif
    |--------------------------------------------------------------------------
    */


    $criteriaList = collect();



    if($testSession->assessmentTemplate)
    {


        $criteriaList =

            $testSession
            ->assessmentTemplate
            ->criterias;


    }





    /*
    |--------------------------------------------------------------------------
    | Hitung hasil pengujian
    |--------------------------------------------------------------------------
    */


    $jumlahPanelis =

        $testSession
        ->assessments
        ->count();



    $jumlahParameter =

        $criteriaList
        ->count();



    $totalNilai =

        $testSession
        ->assessments
        ->sum('total_nilai');






    if(

        $jumlahPanelis > 0

        &&

        $jumlahParameter > 0

    )

    {


        $rataRata =

            $totalNilai /

            (

                $jumlahPanelis *

                $jumlahParameter

            );


    }

    else

    {


        $rataRata = 0;


    }







    /*
    |--------------------------------------------------------------------------
    | Simpan hasil ke tabel test_results
    |--------------------------------------------------------------------------
    */


    TestResult::updateOrCreate(

        [

            'test_session_id'=>$testSession->id

        ],


        [


            'jumlah_panelis'=>$jumlahPanelis,


            'jumlah_parameter'=>$jumlahParameter,


            'total_nilai'=>$totalNilai,


            'rata_rata_produk'=>$rataRata,


            'nilai_mutu'=>

                round(
                    $rataRata * 2
                ) / 2,



            'kategori'=>

                $rataRata >= 7

                ?

                'Baik'

                :

                'Cukup'


        ]


    );







    /*
    |--------------------------------------------------------------------------
    | Refresh data hasil
    |--------------------------------------------------------------------------
    */


    $testSession->load('testResult');







    return view(

        'admin.test_sessions.results',


        compact(

            'testSession',

            'criteriaList',

            'jumlahPanelis',

            'rataRata'

        )

    );


}




    public function exportPdf(TestSession $testSession)
    {


        $testSession->load([

            'sample.product',

            'assessmentTemplate.criterias',

            'assessments.user',

            'assessments.details.criteria',

            'testResult'

        ]);



$criteriaList = collect();


if($testSession->assessmentTemplate)
{

    $criteriaList =
        $testSession
        ->assessmentTemplate
        ->criterias;

}


        $jumlahPanelis =

            $testSession
            ->assessments
            ->count();




        $pdf = Pdf::loadView(

            'admin.test_sessions.pdf',

            compact(

                'testSession',

                'criteriaList',

                'jumlahPanelis'

            )

        );



        return $pdf->download(

            'laporan-hasil-pengujian-'.$testSession->id.'.pdf'

        );

    }






    public function exportExcel(TestSession $testSession)
    {


        return Excel::download(

            new \App\Exports\TestResultExport($testSession),

            'laporan-hasil-pengujian-'.$testSession->id.'.xlsx'

        );

    }







    public function destroy(TestSession $testSession)
    {


        $testSession->sessionUsers()->delete();


        $testSession->assessments()->delete();


        if($testSession->testResult)
        {

            $testSession->testResult->delete();

        }


        $testSession->delete();



        return redirect()

            ->route('admin.test_sessions.index')

            ->with(

                'success',

                'Sesi pengujian berhasil dihapus'

            );

    }



}
