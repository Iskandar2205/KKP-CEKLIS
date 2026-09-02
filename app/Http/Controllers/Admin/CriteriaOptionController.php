<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\CriteriaOption;
use App\Models\Criteria;
use Illuminate\Http\Request;



class CriteriaOptionController extends Controller
{


    /**
     * Menampilkan daftar skala penilaian
     */
    public function index()
    {

        $criteriaOptions = CriteriaOption::with('criteria')
            ->latest()
            ->get();


        return view(
            'admin.criteria_options.index',
            compact('criteriaOptions')
        );

    }





    /**
     * Form tambah skala penilaian
     */
    public function create()
    {

        $criterias = Criteria::all();


        return view(
            'admin.criteria_options.create',
            compact('criterias')
        );

    }





    /**
     * Simpan skala penilaian
     */
    public function store(Request $request)
    {


        $validated = $request->validate([


            'criteria_id' => [
                'required',
                'exists:criteria,id'
            ],


            'nilai' => [
                'required',
                'integer'
            ],


            'deskripsi' => [
                'required',
                'string'
            ]


        ]);




        CriteriaOption::create($validated);




        return redirect()

            ->route('admin.criteria_options.index')

            ->with(
                'success',
                'Skala penilaian berhasil ditambahkan'
            );

    }





    /**
     * Hapus skala penilaian
     */
    public function destroy(CriteriaOption $criteriaOption)
    {


        $criteriaOption->delete();



        return back()

            ->with(
                'success',
                'Skala berhasil dihapus'
            );

    }



}