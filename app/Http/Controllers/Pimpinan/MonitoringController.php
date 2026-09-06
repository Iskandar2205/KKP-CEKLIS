<?php

namespace App\Http\Controllers\Pimpinan;


use App\Http\Controllers\Controller;
use App\Models\TestSession;
use App\Models\Product;

use Illuminate\Http\Request;



class MonitoringController extends Controller
{


    public function index(Request $request)
    {


        /*
        |--------------------------------------------------------------------------
        | Query Monitoring
        |--------------------------------------------------------------------------
        */


        $query = TestSession::with([

            'sample.product',

            'assessments'

        ]);




        /*
        |--------------------------------------------------------------------------
        | Filter Produk
        |--------------------------------------------------------------------------
        */


        if($request->product_id)
        {


            $query->whereHas(

                'sample',

                function($q) use ($request){


                    $q->where(

                        'product_id',

                        $request->product_id

                    );


                }

            );


        }





        /*
        |--------------------------------------------------------------------------
        | Filter Status
        |--------------------------------------------------------------------------
        */


        if($request->status)
        {

            $query->where(

                'status',

                $request->status

            );

        }





        /*
        |--------------------------------------------------------------------------
        | Filter Tanggal
        |--------------------------------------------------------------------------
        */


        if($request->tanggal_mulai)
        {


            $query->whereDate(

                'tanggal_pengujian',

                '>=',

                $request->tanggal_mulai

            );


        }




        if($request->tanggal_selesai)
        {


            $query->whereDate(

                'tanggal_pengujian',

                '<=',

                $request->tanggal_selesai

            );


        }





        /*
        |--------------------------------------------------------------------------
        | Filter Nomor Sample
        |--------------------------------------------------------------------------
        */


        if($request->nomor_sample)
        {


            $query->whereHas(

                'sample',

                function($q) use($request){


                    $q->where(

                        'nomor_sample',

                        'like',

                        '%'.$request->nomor_sample.'%'

                    );


                }

            );


        }





        $sessions = $query

            ->orderBy(

                'tanggal_pengujian',

                'desc'

            )

            ->get();






        $products = Product::orderBy(

            'nama_produk'

        )->get();






        return view(

            'pimpinan.monitoring.index',

            compact(

                'sessions',

                'products'

            )

        );


    }


}