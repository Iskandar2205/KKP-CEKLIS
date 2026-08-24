<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\View\View;



class AuthenticatedSessionController extends Controller
{


    /**
     * Menampilkan halaman login
     */
    public function create(): View
    {

        return view('auth.login');

    }





    /**
     * Proses login user
     */
    public function store(LoginRequest $request): RedirectResponse
    {


        /*
        |--------------------------------------------------------------------------
        | Validasi login
        |--------------------------------------------------------------------------
        |
        | LoginRequest akan melakukan:
        | - pengecekan username/email
        | - pengecekan password
        | - rate limit keamanan login
        |
        */

        $request->authenticate();



        /*
        |--------------------------------------------------------------------------
        | Regenerate session
        |--------------------------------------------------------------------------
        |
        | Security:
        | Mencegah session fixation attack
        |
        */

        $request->session()->regenerate();





        /*
        |--------------------------------------------------------------------------
        | Ambil user yang sedang login
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();




        /*
        |--------------------------------------------------------------------------
        | Redirect berdasarkan role
        |--------------------------------------------------------------------------
        */


        switch ($user->role) {


            case 'admin':

                return redirect()
                    ->route('admin.dashboard');



            case 'panelis':

                return redirect()
                    ->route('panelis.dashboard');



            case 'pimpinan':

                return redirect()
                    ->route('pimpinan.dashboard');



            default:


                /*
                |--------------------------------------------------------------------------
                | Jika role tidak dikenal
                |--------------------------------------------------------------------------
                |
                | Security:
                | user tidak boleh masuk ke halaman yang tidak memiliki izin
                |
                */

                Auth::logout();


                $request->session()->invalidate();


                $request->session()->regenerateToken();



                return redirect('/login')
                    ->withErrors([
                        'email' => 'Role pengguna tidak valid.'
                    ]);

        }


    }






    /**
     * Logout user
     */
    public function destroy(Request $request): RedirectResponse
    {


        /*
        |--------------------------------------------------------------------------
        | Logout user
        |--------------------------------------------------------------------------
        */

        Auth::guard('web')->logout();





        /*
        |--------------------------------------------------------------------------
        | Hapus session
        |--------------------------------------------------------------------------
        |
        | Security:
        | Menghapus seluruh session user
        |
        */

        $request->session()->invalidate();





        /*
        |--------------------------------------------------------------------------
        | Generate CSRF token baru
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerateToken();




        return redirect('/login');


    }


}