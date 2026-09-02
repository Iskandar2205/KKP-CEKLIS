<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Criteria;
use App\Models\CriteriaOption;


class CriteriaOptionSeeder extends Seeder
{

    public function run(): void
    {


        $options = [

            [
                'nilai'=>9,
                'deskripsi'=>'Sangat Baik'
            ],

            [
                'nilai'=>8,
                'deskripsi'=>'Baik Sekali'
            ],

            [
                'nilai'=>7,
                'deskripsi'=>'Baik'
            ],

            [
                'nilai'=>6,
                'deskripsi'=>'Cukup Baik'
            ],

            [
                'nilai'=>5,
                'deskripsi'=>'Cukup'
            ],

            [
                'nilai'=>3,
                'deskripsi'=>'Kurang'
            ],

            [
                'nilai'=>1,
                'deskripsi'=>'Sangat Kurang'
            ],

        ];



        $criteria = Criteria::all();



        foreach($criteria as $item)
        {


            foreach($options as $option)
            {


                CriteriaOption::create([


                    'criteria_id'=>$item->id,

                    'nilai'=>$option['nilai'],

                    'deskripsi'=>$option['deskripsi']


                ]);


            }


        }


    }

}