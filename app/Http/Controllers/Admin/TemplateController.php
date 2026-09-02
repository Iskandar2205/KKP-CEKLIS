<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TemplateController extends Controller
{


    public function index()
    {

        return view(
            'admin.templates.index'
        );

    }



    public function download()
    {

        $file = public_path(
            'template/template_penilaian.xlsx'
        );


        return response()->download($file);

    }





    public function import(Request $request)
    {


        $request->validate([

            'file' => [
                'required',
                'mimes:xlsx,xls'
            ]

        ]);



        return redirect()

            ->route('admin.templates.index')

            ->with(
                'success',
                'File Excel berhasil diupload'
            );


    }


}