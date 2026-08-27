<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Sample;
use App\Models\Product;

use Illuminate\Http\Request;



class SampleController extends Controller
{


    /**
     * Menampilkan daftar sample
     */
    public function index()
    {


        $samples = Sample::with('product')
            ->latest()
            ->get();



        return view('admin.samples.index', compact('samples'));

    }





    /**
     * Form tambah sample
     */
    public function create()
    {


        $products = Product::all();



        return view('admin.samples.create', compact('products'));

    }





    /**
     * Simpan sample
     */
    public function store(Request $request)
    {


        $validated = $request->validate([


            'product_id' => [
                'required',
                'exists:products,id'
            ],


            'nomor_sample' => [
                'required',
                'string',
                'max:255'
            ],


            'kode_sample' => [
                'required',
                'string',
                'max:255'
            ],


            'tanggal' => [
                'required',
                'date'
            ],


        ]);





        Sample::create($validated);




        return redirect()
            ->route('admin.samples.index')
            ->with(
                'success',
                'Sample berhasil ditambahkan'
            );

    }






    /**
     * Form edit sample
     */
    public function edit(Sample $sample)
    {


        $products = Product::all();



        return view(
            'admin.samples.edit',
            compact(
                'sample',
                'products'
            )
        );

    }





    /**
     * Update sample
     */
    public function update(Request $request, Sample $sample)
    {


        $validated = $request->validate([


            'product_id' => [
                'required',
                'exists:products,id'
            ],


            'nomor_sample' => [
                'required',
                'string',
                'max:255'
            ],


            'kode_sample' => [
                'required',
                'string',
                'max:255'
            ],


            'tanggal' => [
                'required',
                'date'
            ],


        ]);




        $sample->update($validated);



        return redirect()
            ->route('admin.samples.index')
            ->with(
                'success',
                'Sample berhasil diperbarui'
            );


    }






    /**
     * Hapus sample
     */
    public function destroy(Sample $sample)
    {


        $sample->delete();



        return redirect()
            ->route('admin.samples.index')
            ->with(
                'success',
                'Sample berhasil dihapus'
            );


    }


}