<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{


    /**
     * Menampilkan daftar user
     */
    public function index()
    {


        $users = User::latest()->get();



        return view(
            'admin.users.index',
            compact('users')
        );


    }







    /**
     * Form tambah user
     */
    public function create()
    {


        return view(
            'admin.users.create'
        );


    }







    /**
     * Simpan user
     */
    public function store(Request $request)
    {


        $validated = $request->validate([


            'name'=>'required',

            'username'=>'required|unique:users',

            'email'=>'required|email|unique:users',

            'password'=>'required|min:6', 

            'role'=>'required',

            'status'=>'required',


        ]);





        User::create([


            'name'=>$request->name,


            'username'=>$request->username,


            'email'=>$request->email,


            'password'=>Hash::make($request->password),


            'role'=>$request->role,


            'status'=>$request->status,


        ]);






        return redirect()

            ->route('admin.users.index')

            ->with(
                'success',
                'User berhasil ditambahkan'
            );


    }








    /**
     * Form edit
     */
    public function edit(User $user)
    {


        return view(

            'admin.users.edit',

            compact('user')

        );


    }









    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {


        $validated = $request->validate([


            'name'=>'required',

            'username'=>'required',

            'email'=>'required|email',

            'role'=>'required',

            'status'=>'required',


        ]);





        $user->update([


            'name'=>$request->name,

            'username'=>$request->username,

            'email'=>$request->email,

            'role'=>$request->role,

            'status'=>$request->status,


        ]);






        return redirect()

            ->route('admin.users.index')

            ->with(
                'success',
                'User berhasil diperbarui'
            );


    }








    /**
     * Hapus user
     */
    public function destroy(User $user)
    {


        $user->delete();



        return redirect()

            ->route('admin.users.index')

            ->with(
                'success',
                'User berhasil dihapus'
            );


    }



}