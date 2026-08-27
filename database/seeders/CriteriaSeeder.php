<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

use App\Models\Criteria;



class CriteriaSeeder extends Seeder
{


    public function run(): void
    {


        $criteria = [


            [
                'nama_kriteria' => 'Lapisan Es'
            ],


            [
                'nama_kriteria' => 'Pengeringan'
            ],


            [
                'nama_kriteria' => 'Perubahan Warna'
            ],


            [
                'nama_kriteria' => 'Kenampakan'
            ],


            [
                'nama_kriteria' => 'Bau'
            ],


            [
                'nama_kriteria' => 'Tekstur'
            ],


        ];





        foreach($criteria as $item)
        {


            Criteria::updateOrCreate(

                [
                    'nama_kriteria' => $item['nama_kriteria']
                ],

                $item

            );


        }


    }


}