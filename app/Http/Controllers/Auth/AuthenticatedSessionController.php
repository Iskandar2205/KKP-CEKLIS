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
        | Authentication
        |--------------------------------------------------------------------------
        |
        | LoginRequest melakukan:
        | - validasi username
        | - cek password
        | - rate limit login
        |
        */

        $request->authenticate();



        /*
        |--------------------------------------------------------------------------
        | Regenerate Session
        |--------------------------------------------------------------------------
        |
        | Security:
        | Mencegah session fixation attack
        |
        */

        $request->session()->regenerate();



        /*
        |--------------------------------------------------------------------------
        | Ambil user login
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();



        /*
        |--------------------------------------------------------------------------
        | Validasi user
        |--------------------------------------------------------------------------
        |
        | Jika user tidak ditemukan,
        | logout dan hentikan proses.
        |
        */

        if (!$user) {

            Auth::logout();

            return redirect()
                ->route('login');

        }





        /*
        |--------------------------------------------------------------------------
        | Redirect berdasarkan role
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {


            return redirect()
                ->route('admin.dashboard');


        }



        if ($user->role === 'panelis') {


            return redirect()
                ->route('panelis.dashboard');


        }




        if ($user->role === 'pimpinan') {


            return redirect()
                ->route('pimpinan.dashboard');


        }




        /*
        |--------------------------------------------------------------------------
        | Role tidak valid
        |--------------------------------------------------------------------------
        |
        | Security:
        | User dengan role asing tidak boleh masuk sistem.
        |
        */


        Auth::logout();


        $request->session()->invalidate();


        $request->session()->regenerateToken();



        return redirect()
            ->route('login')
            ->withErrors([
                'username' => 'Role pengguna tidak memiliki akses.'
            ]);

    }








    /**
     * Logout user
     */
    public function destroy(Request $request): RedirectResponse
    {


        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */

        Auth::guard('web')->logout();




        /*
        |--------------------------------------------------------------------------
        | Hapus session
        |--------------------------------------------------------------------------
        |
        | Security:
        | Menghapus session lama setelah logout.
        |
        */


        $request->session()->invalidate();




        /*
        |--------------------------------------------------------------------------
        | Generate CSRF baru
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerateToken();



        return redirect()
            ->route('login');

    }


}