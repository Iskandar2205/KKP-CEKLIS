<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard pimpinan
     */
    public function index()
    {
        $user = Auth::user();

        return view('pimpinan.dashboard', compact('user'));
    }
}