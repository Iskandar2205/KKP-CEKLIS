<?php

namespace App\Http\Controllers\Panelis;


use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Models\SessionUser;



class DashboardController extends Controller
{


public function index()
{

    $user = auth()->user();


    $sessions = \App\Models\SessionUser::where(
        'user_id',
        $user->id
    )
    ->with([
        'testSession.sample.product'
    ])
    ->get();



    return view(
        'panelis.dashboard',
        compact('sessions')
    );

}


}