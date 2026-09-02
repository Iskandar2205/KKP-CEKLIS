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
                'username'=>'admin'
            ],

            [

                'name'=>'Admin BPPMHKP',

                'username'=>'admin',

                'email'=>'admin@gmail.com',

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

                'name'=>'Budi Santoso',

                'username'=>'P001',

                'email'=>'budi@gmail.com',

            ],



            [

                'name'=>'Ridwan Saputra',

                'username'=>'P002',

                'email'=>'ridwan@gmail.com',

            ],



            [

                'name'=>'Ahmad Fauzi',

                'username'=>'P003',

                'email'=>'ahmad@gmail.com',

            ],



            [

                'name'=>'Siti Rahma',

                'username'=>'P004',

                'email'=>'siti@gmail.com',

            ],



            [

                'name'=>'Dewi Lestari',

                'username'=>'P005',

                'email'=>'dewi@gmail.com',

            ],


        ];





        foreach($panelis as $data)

        {


            User::updateOrCreate(

                [

                    // cari user lama berdasarkan username
                    'username'=>$data['username']

                ],


                [

                    'name'=>$data['name'],

                    'email'=>$data['email'],

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

                'username'=>'penyelia'

            ],

            [

                'name'=>'Penyelia 01 - Pak Wirsan',

                'username'=>'penyelia',

                'email'=>'penyelia@gmail.com',

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

                'username'=>'analis'

            ],

            [

                'name'=>'Analis 01',

                'username'=>'analis',

                'email'=>'analis@gmail.com',

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

                'username'=>'pimpinan'

            ],

            [

                'name'=>'Pimpinan',

                'username'=>'pimpinan',

                'email'=>'pimpinan@gmail.com',

                'password'=>Hash::make('password'),

                'role'=>'pimpinan',

                'status'=>'aktif',

            ]

        );


    }

}