<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{

    public function run(): void
    {


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



        User::updateOrCreate(

            [
                'email'=>'panelis@gmail.com'
            ],

            [

                'name'=>'Panelis 01',

                'username'=>'P001',

                'password'=>Hash::make('password'),

                'role'=>'panelis',

                'status'=>'aktif',

            ]

        );



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