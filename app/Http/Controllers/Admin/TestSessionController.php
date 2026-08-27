<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\TestSession;
use App\Models\Sample;
use App\Models\User;

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



        $panelis = User::where('role','panelis')
            ->where('status','aktif')
            ->get();



        $penyelia = User::where('role','penyelia')
            ->where('status','aktif')
            ->get();

        return view(

            'admin.test_sessions.create',

            compact(
                'samples',
                'panelis',
                'penyelia',
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



            'panelis'=>[
                'required',
                'array'
            ],


            'panelis.*'=>[
                'exists:users,id'
            ],



            'penyelia'=>[
                'nullable',
                'exists:users,id'
            ],


        ]);





        /*
        |--------------------------------------------------------------------------
        | Simpan Test Session
        |--------------------------------------------------------------------------
        */


        $session = TestSession::create($validated);







        /*
        |--------------------------------------------------------------------------
        | Simpan Panelis
        |--------------------------------------------------------------------------
        */


        foreach($request->panelis as $userId)
        {


            $session->sessionUsers()->create([

                'user_id'=>$userId,

                'role'=>'panelis'

            ]);


        }








        /*
        |--------------------------------------------------------------------------
        | Simpan Penyelia
        |--------------------------------------------------------------------------
        */


        if($request->penyelia)
        {


            $session->sessionUsers()->create([

                'user_id'=>$request->penyelia,

                'role'=>'penyelia'

            ]);


        }








        /*
        |--------------------------------------------------------------------------
        | Simpan Analis
        |--------------------------------------------------------------------------
        */


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



        return view(

            'admin.test_sessions.edit',

            compact(
                'testSession',
                'samples'
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



            'panelis'=>[
                'required',
                'array'
            ],



            'panelis.*'=>[
                'exists:users,id'
            ],



            'penyelia'=>[
                'nullable',
                'exists:users,id'
            ],



            'analis'=>[
                'nullable',
                'exists:users,id'
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
 * Membuka sesi pengujian
 */
public function open(TestSession $testSession)
{


    $testSession->update([

        'status'=>'dibuka'

    ]);



    return redirect()

        ->route('admin.test_sessions.index')

        ->with(
            'success',
            'Sesi berhasil dibuka'
        );


}






/**
 * Menyelesaikan sesi pengujian
 */
public function finish(TestSession $testSession)
{


    $testSession->update([

        'status'=>'selesai'

    ]);



    return redirect()

        ->route('admin.test_sessions.index')

        ->with(
            'success',
            'Sesi berhasil diselesaikan'
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


}