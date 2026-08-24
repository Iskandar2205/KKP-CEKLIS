<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard admin
     */
    public function index()
    {
        // Mengambil data user yang sedang login
        $user = Auth::user();

        // Mengirim data user ke halaman dashboard admin
        return view('admin.dashboard', compact('user'));
    }
}