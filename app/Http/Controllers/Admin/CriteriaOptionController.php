<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\CriteriaOption;
use Illuminate\Http\Request;



class CriteriaOptionController extends Controller
{

    public function index()
    {

        $criteriaOptions = CriteriaOption::latest()->get();


        return view(
            'admin.criteria_options.index',
            compact('criteriaOptions')
        );

    }



    public function create()
    {

        return view(
            'admin.criteria_options.create'
        );

    }



    public function store(Request $request)
    {

        $request->validate([

            'nilai'=>'required|integer',

            'deskripsi'=>'required|string'

        ]);



        CriteriaOption::create([

            'nilai'=>$request->nilai,

            'deskripsi'=>$request->deskripsi

        ]);



        return redirect()

        ->route('admin.criteria_options.index')

        ->with(
            'success',
            'Skala penilaian berhasil ditambahkan'
        );

    }



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