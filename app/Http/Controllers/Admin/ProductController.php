<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\AssessmentTemplate;
use Illuminate\Http\Request;
use App\Imports\DatasetImport;
use App\Imports\PreviewImport;
use Maatwebsite\Excel\Facades\Excel;


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
     * Halaman upload template penilaian + preview Excel
     */
    public function dataset(Product $product)
    {

        $template = AssessmentTemplate::where(
            'product_id',
            $product->id
        )->first();


        $rows = [];


        if($template && $template->file_template)
        {

            $path = storage_path(
                'app/private/templates/'.$template->file_template
            );


           if(file_exists($path))
{

    $preview = new PreviewImport();

    Excel::import(
        $preview,
        $path
    );


    $rows = $preview->rows;

}

        }


        return view(
            'admin.products.dataset',
            compact(
                'product',
                'template',
                'rows'
            )
        );

    }





    /**
     * Upload template Excel penilaian
     */
    public function importDataset(
        Request $request,
        Product $product
    )
    {

        $request->validate([

            'file'=>[
                'required',
                'file',
                'mimes:xlsx,xls'
            ]

        ]);



        $file = $request->file('file');


        $filename = time().'_'.$file->getClientOriginalName();



        /*
        Simpan file Excel
        Laravel 12 default:
        storage/app/private
        */

        $file->storeAs(
            'templates',
            $filename
        );



        /*
        Import isi Excel ke database
        */

        Excel::import(
            new DatasetImport($product->id),
            $file
        );





        /*
        Simpan informasi template
        */

        AssessmentTemplate::updateOrCreate(

            [
                'product_id'=>$product->id
            ],

            [
                'nama_template'=>'Template Organoleptik '.$product->nama_produk,

                'file_template'=>$filename
            ]

        );





        return redirect()

            ->route(
                'admin.products.dataset',
                $product->id
            )

            ->with(
                'success',
                'Template berhasil diupload'
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
     * Simpan produk baru
     */
    public function store(Request $request)
    {

        $validated = $request->validate([

            'nama_produk'=>[
                'required',
                'string',
                'max:100'
            ],


            'jenis_produk'=>[
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

            'nama_produk'=>[
                'required',
                'string',
                'max:100'
            ],


            'jenis_produk'=>[
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