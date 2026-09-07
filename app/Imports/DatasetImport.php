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
        |--------------------------------------------------------------------------
        | TEMPLATE
        |--------------------------------------------------------------------------
        */


        $template = AssessmentTemplate::create([

            'product_id' => $this->productId,

            'nama_template' => 'Template Organoleptik'

        ]);






        /*
        |--------------------------------------------------------------------------
        | SECTION
        |--------------------------------------------------------------------------
        */


        $section = AssessmentSection::create([

            'assessment_template_id' => $template->id,

            'nama_section' => 'Penilaian Organoleptik',

            'urutan' => 1

        ]);






        $criteria = null;

        $urutan = 1;






        foreach($rows as $row)
        {



            /*
            Ambil seluruh isi baris
            */

            $data = collect($row)
                ->filter(function($item){

                    return trim((string)$item) !== '';

                })
                ->map(function($item){

                    return trim((string)$item);

                })
                ->values();





            if($data->isEmpty())
            {
                continue;
            }






            /*
            |--------------------------------------------------------------------------
            | DETEKSI PARAMETER
            |
            | Contoh:
            | 1. Kenampakan
            | 2. Bau
            |--------------------------------------------------------------------------
            */


            $kolomPertama = $data->first();




            if(
                preg_match(
                    '/^\s*\d+[\.\)]\s*(.+)$/',
                    $kolomPertama,
                    $match
                )
            )
            {


                $namaKriteria = trim($match[1]);



                /*
                Abaikan judul/header
                */


                $blacklist = [

                    'lembar',

                    'penilaian',

                    'panelis',

                    'tanggal',

                    'produk',

                    'parameter',

                    'kriteria',

                    'nilai',

                    'deskripsi'

                ];



                $skip = false;



                foreach($blacklist as $kata)
                {

                    if(
                        stripos(
                            strtolower($namaKriteria),
                            $kata
                        ) !== false
                    )
                    {

                        $skip = true;

                        break;

                    }

                }




                if(!$skip)
                {


                    $criteria = Criteria::create([


                        'assessment_section_id'
                            =>
                        $section->id,


                        'nama_kriteria'
                            =>
                        $namaKriteria,


                        'urutan'
                            =>
                        $urutan++


                    ]);



                    continue;


                }


            }









            /*
            |--------------------------------------------------------------------------
            | DETEKSI NILAI OPTION
            |
            | Contoh:
            |
            | Warna merah cerah | 9
            |--------------------------------------------------------------------------
            */



            if($criteria)
            {



                $nilai = null;



                foreach($data as $item)
                {


                    if(is_numeric($item))
                    {

                        $nilai = (int)$item;

                        break;

                    }


                }






                if($nilai !== null)
                {



                    $deskripsi = $data

                        ->filter(function($item){

                            return !is_numeric($item);

                        })

                        ->implode(' ');





                    CriteriaOption::create([


                        'criteria_id'
                            =>
                        $criteria->id,


                        'nilai'
                            =>
                        $nilai,


                        'deskripsi'
                            =>
                        $deskripsi


                    ]);



                }


            }



        }



    }


}