<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

use App\Models\User;

use Illuminate\Support\Facades\Hash;



class UserSeeder extends Seeder
{


    public function run(): void
    {



        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */


        User::updateOrCreate(

            [

                'email'=>'admin@gmail.com'

            ],

            [

                'name'=>'Admin BPPMHKP',

                'username'=>'admin',

                'password'=>Hash::make('password'),

                'role'=>'admin',

                'status'=>'aktif',

            ]

        );






/*
|--------------------------------------------------------------------------
| Panelis
|--------------------------------------------------------------------------
*/


$panelis = [


    [
        'name'=>'Panelis 01',
        'username'=>'P001',
        'email'=>'panelis1@gmail.com',
    ],


    [
        'name'=>'Panelis 02',
        'username'=>'P002',
        'email'=>'panelis2@gmail.com',
    ],


    [
        'name'=>'Panelis 03',
        'username'=>'P003',
        'email'=>'panelis3@gmail.com',
    ],


    [
        'name'=>'Panelis 04',
        'username'=>'P004',
        'email'=>'panelis4@gmail.com',
    ],


    [
        'name'=>'Panelis 05',
        'username'=>'P005',
        'email'=>'panelis5@gmail.com',
    ],


];




foreach($panelis as $data)

{


    User::updateOrCreate(

        [

            'email'=>$data['email']

        ],


        [

            'name'=>$data['name'],


            'username'=>$data['username'],


            'password'=>Hash::make('password'),


            'role'=>'panelis',


            'status'=>'aktif',


        ]

    );


}







        /*
        |--------------------------------------------------------------------------
        | Penyelia
        |--------------------------------------------------------------------------
        */


        User::updateOrCreate(

            [

                'email'=>'penyelia@gmail.com'

            ],

            [

                'name'=>'Penyelia 01 - Pak Wirsan',

                'username'=>'penyelia',

                'password'=>Hash::make('password'),

                'role'=>'penyelia',

                'status'=>'aktif',

            ]

        );








        /*
        |--------------------------------------------------------------------------
        | Analis
        |--------------------------------------------------------------------------
        */


        User::updateOrCreate(

            [

                'email'=>'analis@gmail.com'

            ],

            [

                'name'=>'Analis 01',

                'username'=>'analis',

                'password'=>Hash::make('password'),

                'role'=>'analis',

                'status'=>'aktif',

            ]

        );







        /*
        |--------------------------------------------------------------------------
        | Pimpinan
        |--------------------------------------------------------------------------
        */


        User::updateOrCreate(

            [

                'email'=>'pimpinan@gmail.com'

            ],

            [

                'name'=>'Pimpinan',

                'username'=>'pimpinan',

                'password'=>Hash::make('password'),

                'role'=>'pimpinan',

                'status'=>'aktif',

            ]

        );


    }

}