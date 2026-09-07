<?php

namespace App\Exports;


use App\Models\TestSession;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;



class TestResultExport implements FromCollection, WithHeadings
{

    protected $testSession;


    public function __construct(TestSession $testSession)
    {

        $this->testSession = $testSession;


        $this->testSession->load([

            'assessmentTemplate.criterias',

            'assessments.user',

            'assessments.details.criteria',

            'testResult'

        ]);

    }




    public function headings(): array
    {

        $header = [

            'No',
            'Panelis'

        ];



        foreach(
            $this->testSession
            ->assessmentTemplate
            ->criterias
            as $criteria
        )
        {

            $header[] =
                $criteria->nama_kriteria;

        }



        $header[]='Jumlah';

        $header[]='Rata-rata';


        $header[]='Konstanta';

        $header[]='n';

        $header[]='√n';

        $header[]='s²';

        $header[]='s';

        $header[]='Pmin';

        $header[]='Pmax';

        $header[]='Nilai Mutu';


        return $header;

    }




public function collection(): \Illuminate\Support\Collection
{

        $data = collect();


        $criterias =
            $this->testSession
            ->assessmentTemplate
            ->criterias;



        foreach(
            $this->testSession->assessments
            as $index=>$assessment
        )
        {


            $row=[];


            $row[]=$index+1;


            $row[]=
                $assessment->user->name ?? '-';



            $jumlah=0;



            foreach($criterias as $criteria)
            {

                $nilai =
                    $assessment
                    ->details
                    ->where(
                        'criteria_id',
                        $criteria->id
                    )
                    ->first()
                    ->nilai ?? 0;


                $row[]=$nilai;


                $jumlah += $nilai;

            }




            $rata =
                count($criterias)
                ?
                round(
                    $jumlah/count($criterias),
                    2
                )
                :
                0;



            $row[]=$jumlah;

            $row[]=$rata;



            /*
            Statistik
            */


            $result =
                $this->testSession
                ->testResult;



            $row[]=
                $result->konstanta ?? '-';


            $row[]=
                $result->n ?? '-';


            $row[]=
                $result->akar_n ?? '-';


            $row[]=
                $result->s2 ?? '-';


            $row[]=
                $result->s ?? '-';


            $row[]=
                $result->p_min ?? '-';


            $row[]=
                $result->p_max ?? '-';


            $row[]=
                $result->nilai_mutu ?? '-';



            $data->push($row);


        }



        return $data;


    }


}