<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    /**
     * Menampilkan daftar produk
     */
    public function index()
    {

        $products = Product::latest()->get();


        return view(
            'admin.products.index',
            compact('products')
        );

    }



    /**
     * Form tambah produk
     */
    public function create()
    {

        return view(
            'admin.products.create'
        );

    }




    /**
     * Menyimpan produk baru
     */
    public function store(Request $request)
    {


        $validated = $request->validate([

            'nama_produk' => [
                'required',
                'string',
                'max:100'
            ],


            'jenis_produk' => [
                'required',
                'string',
                'max:100'
            ]

        ]);



        Product::create($validated);



        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan'
            );

    }




    /**
     * Form edit produk
     */
    public function edit(Product $product)
    {

        return view(
            'admin.products.edit',
            compact('product')
        );

    }




    /**
     * Update produk
     */
    public function update(
        Request $request,
        Product $product
    )
    {


        $validated = $request->validate([

            'nama_produk' => [
                'required',
                'string',
                'max:100'
            ],


            'jenis_produk' => [
                'required',
                'string',
                'max:100'
            ]

        ]);



        $product->update($validated);



        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produk berhasil diperbarui'
            );


    }




    /**
     * Hapus produk
     */
    public function destroy(Product $product)
    {

        $product->delete();


        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produk berhasil dihapus'
            );

    }


}