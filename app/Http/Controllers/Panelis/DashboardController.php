<?php

namespace App\Http\Controllers\Panelis;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard panelis
     */
    public function index()
    {
        $user = Auth::user();

        return view('panelis.dashboard', compact('user'));
    }
}