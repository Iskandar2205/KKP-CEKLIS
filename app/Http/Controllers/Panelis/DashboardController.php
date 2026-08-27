<?php

namespace App\Http\Controllers\Panelis;


use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Models\SessionUser;



class DashboardController extends Controller
{


    public function index()
    {


        $user = Auth::user();





        $sessions = SessionUser::with([

                'testSession.sample.product'

            ])

            ->where('user_id',$user->id)

            ->where('role','panelis')

            ->whereHas('testSession', function($query){


                $query->where('status','dibuka');


            })

            ->get();






        return view(

            'panelis.dashboard',

            compact('sessions')

        );


    }


}