<?php

namespace App\Imports;


use App\Models\AssessmentTemplate;
use App\Models\AssessmentSection;
use App\Models\Criteria;
use App\Models\CriteriaOption;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;



class DatasetImport implements ToCollection
{


    protected $productId;



    public function __construct($productId)
    {
        $this->productId = $productId;
    }




    public function collection(Collection $rows): void
    {



        /*
        Template
        */

        $template = AssessmentTemplate::firstOrCreate(

            [
                'product_id'=>$this->productId
            ],

            [
                'nama_template'=>'Template Organoleptik'
            ]

        );





        /*
        Section
        */

        $section = AssessmentSection::firstOrCreate(

            [

                'assessment_template_id'=>$template->id,

                'nama_section'=>'Penilaian Sensori'

            ],

            [

                'urutan'=>1

            ]

        );





        /*
        Variabel kriteria aktif
        */

        $criteria = null;



        foreach($rows->skip(2) as $row)
        {



            $kolomA = trim($row[0] ?? '');

            $kolomB = trim($row[1] ?? '');




            if(empty($kolomA))
            {
                continue;
            }




            /*
            Jika kolom A adalah judul kriteria
            contoh:
            1 Kenampakan
            2 Bau
            */

            if(
                preg_match('/^[0-9]+\s+(.*)$/',$kolomA,$match)
            )
            {


                $namaKriteria = trim($match[1]);



                $criteria = Criteria::create([

                    'assessment_section_id'=>$section->id,

                    'nama_kriteria'=>$namaKriteria,

                    'urutan'=>1

                ]);



                continue;

            }






            /*
            Jika kolom B adalah nilai angka
            berarti ini option
            */


            if(
                is_numeric($kolomB)
                &&
                $criteria
            )
            {


                CriteriaOption::create([


                    'criteria_id'=>$criteria->id,


                    'nilai'=>(int)$kolomB,


                    'deskripsi'=>$kolomA


                ]);

            }




        }


    }


}