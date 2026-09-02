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
        Buat Template
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
        Buat Section
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





        foreach ($rows->skip(2) as $row)
        {



            // format:
             // kolom 0 = nama kriteria
            // kolom 1 = nilai angka
            // kolom 2 = deskripsi/keterangan


            if(
    empty($row[0]) ||
    !is_numeric($row[1])
)
{
    continue;
}





            /*
            Buat Criteria
            */$criteria = Criteria::firstOrCreate(

    [

        'assessment_section_id'=>$section->id,

        'nama_kriteria'=>$row[0],

    ],

    [

        'urutan'=>1

    ]

);

            /*
            Buat pilihan nilai
            */


CriteriaOption::firstOrCreate(

[
    'criteria_id'=>$criteria->id,

    'nilai'=>(int)trim($row[1])

],

[
    'deskripsi'=>trim($row[2] ?? '-')

]

);



        }


    }


}