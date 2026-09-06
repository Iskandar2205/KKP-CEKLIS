<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TestSession;
use App\Models\Sample;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;



class TestSessionController extends Controller
{


    /**
     * Menampilkan semua sesi pengujian
     */
    public function index()
    {


        $sessions = TestSession::with('sample.product')
            ->latest()
            ->get();



        return view(
            'admin.test_sessions.index',
            compact('sessions')
        );
    }







    /**
     * Form tambah sesi
     */
    public function create()
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

            'admin.test_sessions.create',

            compact(
                'samples',
                'panelis',
                'penyelia'
            )

        );
    }




    /**
     * Simpan sesi pengujian
     */
    public function store(Request $request)
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



            'panelis' => [
                'required',
                'array'
            ],



            'panelis.*' => [
                'required',
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


            'sample_id' => $request->sample_id,


            'tanggal_pengujian' => $request->tanggal_pengujian,


            'status' => $request->status,


            'catatan' => $request->catatan,


        ]);










        /*
        |--------------------------------------------------------------------------
        | Simpan Panelis
        |--------------------------------------------------------------------------
        */


        foreach ($request->panelis as $panelisId) {


            $session->sessionUsers()->create([


                'user_id' => $panelisId,


                'role' => 'panelis'


            ]);
        }









        /*
        |--------------------------------------------------------------------------
        | Simpan Penyelia
        |--------------------------------------------------------------------------
        */


        if ($request->penyelia) {


            $session->sessionUsers()->create([


                'user_id' => $request->penyelia,


                'role' => 'penyelia'


            ]);
        }








        return redirect()

            ->route('admin.test_sessions.index')

            ->with(
                'success',
                'Sesi pengujian berhasil dibuat'
            );
    }









    /**
     * Detail sesi pengujian
     */
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









    /**
     * Form edit sesi
     */
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









    /**
     * Update sesi
     */
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





        $testSession->update($validated);





        return redirect()

            ->route('admin.test_sessions.index')

            ->with(
                'success',
                'Sesi berhasil diperbarui'
            );
    }









    /**
     * Membuka sesi
     */
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









    /**
     * Menyelesaikan sesi
     */
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

    /**
     * Menampilkan hasil penilaian organoleptik
     */
    public function results(TestSession $testSession)
    {

        $testSession->load([

            'sample.product',

            'assessments.user',

            'assessments.details.criteria'

        ]);



        $assessments = $testSession->assessments;



        $criteriaList = collect();



        foreach ($assessments as $assessment) {

            foreach ($assessment->details as $detail) {

                $criteriaList->push(
                    $detail->criteria
                );
            }
        }



        $criteriaList = $criteriaList
            ->unique('id')
            ->values();



        $rekap = [];



        foreach ($criteriaList as $criteria) {

            $rekap[$criteria->nama_kriteria] =
                $assessments->sum(function ($assessment) use ($criteria) {

                    return $assessment
                        ->details
                        ->where(
                            'criteria_id',
                            $criteria->id
                        )
                        ->sum('nilai');
                });
        }




        $jumlahPanelis = $assessments->count();



        $totalSemua = $assessments->sum('total_nilai');



        $rataRata = $jumlahPanelis > 0
            ? round(
                $totalSemua /
                    ($jumlahPanelis * $criteriaList->count()),
                2
            )
            : 0;



        return view(

            'admin.test_sessions.results',

            compact(

                'testSession',
                'criteriaList',
                'rekap',
                'jumlahPanelis',
                'totalSemua',
                'rataRata'

            )

        );
    }

    public function exportExcel(TestSession $testSession)
    {


        $testSession->load([

            'sample.product',

            'assessments.user',

            'assessments.details.criteria'

        ]);



        return Excel::download(

            new \App\Exports\TestSessionResultExport($testSession),

            'hasil_pengujian_' . $testSession->sample->nomor_sample . '.xlsx'

        );
    }




    /**
     * Hapus sesi
     */
    public function destroy(TestSession $testSession)
    {


        $testSession->delete();



        return redirect()

            ->route('admin.test_sessions.index')

            ->with(
                'success',
                'Sesi berhasil dihapus'
            );
    }

   public function exportPdf(TestSession $testSession)
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


    $filename = 
        'Hasil_Uji_' .
        $testSession->sample->nomor_sample .
        '.pdf';



    return response($pdf->output(), 200)

        ->header(
            'Content-Type',
            'application/pdf'
        )

        ->header(
            'Content-Disposition',
            'attachment; filename="'.$filename.'"'
        )

        ->header(
            'Cache-Control',
            'no-cache, no-store, must-revalidate'
        )

        ->header(
            'Pragma',
            'no-cache'
        )

        ->header(
            'Expires',
            '0'
        );

}
    public function downloadPdf(TestSession $testSession)
    {
        $pdf = Pdf::loadView(
            'admin.test_sessions.pdf',
            compact('testSession')
        )
            ->setPaper('a4', 'landscape');

        return $pdf->download(
            'hasil_pengujian_' . $testSession->sample->nomor_sample . '.pdf'
        );
    }
}
