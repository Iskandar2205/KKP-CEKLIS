<?php

namespace App\Services;

use App\Models\TestResult;


class OrganolepticCalculationService
{


    public function calculate($testSession)
    {


        /*
        Validasi template pengujian
        */

        if(!$testSession->assessmentTemplate){

            throw new \Exception(
                'Template pengujian belum dipilih'
            );

        }



        /*
        Ambil jumlah parameter dinamis
        berdasarkan template
        */

        $jumlahParameter =
            $testSession
            ->assessmentTemplate
            ->criterias
            ->count();



        if($jumlahParameter == 0){

            throw new \Exception(
                'Template belum memiliki kriteria'
            );

        }




        /*
        Ambil assessment panelis selesai
        */

        $assessments = $testSession
            ->assessments()
            ->where('status','selesai')
            ->with('details')
            ->get();



        if($assessments->count()==0){

            return null;

        }





        $totalNilai = 0;

        $rataPanelis = [];

        $jumlahPanelis = 0;





        /*
        Hitung nilai setiap panelis

        Jumlah nilai panelis
        Rata-rata panelis

        */

        foreach($assessments as $assessment){



            /*
            Pastikan semua parameter terisi
            */

            if(
                $assessment->details->count()
                !=
                $jumlahParameter
            ){

                continue;

            }





            $jumlahNilaiPanelis =
                $assessment
                ->details
                ->sum('nilai');




            $totalNilai += $jumlahNilaiPanelis;



            $rataPanelis[] =
                $jumlahNilaiPanelis /
                $jumlahParameter;



            $jumlahPanelis++;



        }






        if($jumlahPanelis == 0){

            throw new \Exception(
                'Belum ada panelis dengan data lengkap'
            );

        }





        /*
        Rata-rata produk (x bar)

        Total seluruh nilai /
        (jumlah panelis x jumlah parameter)

        */

        $rataProduk =

            $totalNilai /
            (
                $jumlahPanelis *
                $jumlahParameter
            );








        /*
        Hitung varians (s²)

        */

        $jumlahKuadrat = 0;



        foreach($rataPanelis as $nilai){


            $jumlahKuadrat +=

                pow(
                    ($nilai - $rataProduk),
                    2
                );


        }






        if($jumlahPanelis > 1){


            $varians =

                $jumlahKuadrat /
                ($jumlahPanelis - 1);


        }
        else{


            $varians = 0;


        }








        /*
        Standar deviasi (s)

        */

        $standarDeviasi =

            sqrt($varians);








        /*
        Konstanta statistik

        Confidence Level 95%

        */

        $z = 1.96;






        /*
        Hitung akar n

        */

        $akarN =

            sqrt($jumlahPanelis);








        /*
        Error Statistik

        Z*s/√n

        */

        if($akarN > 0){


            $error =

                (
                    $z *
                    $standarDeviasi
                )
                /
                $akarN;


        }
        else{


            $error = 0;


        }








        /*
        Interval mutu

        */

        $pMin =

            $rataProduk -
            $error;



        $pMax =

            $rataProduk +
            $error;








        /*
        Nilai mutu akhir P

        Pembulatan x bar
        ke 0.5 terdekat

        */

        $nilaiMutu =

            round(
                $rataProduk * 2
            )
            /
            2;








        /*
        Kategori mutu

        */

        if($nilaiMutu >= 8){

            $kategori = "Sangat Baik";

        }
        elseif($nilaiMutu >= 7){

            $kategori = "Baik";

        }
        elseif($nilaiMutu >= 5){

            $kategori = "Cukup";

        }
        else{

            $kategori = "Tidak Baik";

        }







        /*
        Simpan hasil perhitungan

        */

        return TestResult::updateOrCreate(

            [

                'test_session_id'
                =>
                $testSession->id

            ],


            [

                'jumlah_panelis'
                =>
                $jumlahPanelis,


                'jumlah_parameter'
                =>
                $jumlahParameter,


                'total_nilai'
                =>
                $totalNilai,


                'rata_rata_produk'
                =>
                $rataProduk,


                'z_score'
                =>
                $z,


                'akar_n'
                =>
                $akarN,


                'varians'
                =>
                $varians,


                'standar_deviasi'
                =>
                $standarDeviasi,


                'error'
                =>
                $error,


                'p_min'
                =>
                $pMin,


                'p_max'
                =>
                $pMax,


                'nilai_mutu'
                =>
                $nilaiMutu,


                'kategori'
                =>
                $kategori

            ]

        );


    }


}