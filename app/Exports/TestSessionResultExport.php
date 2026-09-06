<?php

namespace App\Exports;

use App\Models\TestSession;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Events\AfterSheet;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;


class TestSessionResultExport implements FromArray, WithEvents
{

    protected $testSession;


    public function __construct(TestSession $testSession)
    {
        $this->testSession = $testSession;
    }



    public function array(): array
    {

        $rows = [];


        $assessments = $this->testSession->assessments;


        $jumlahKenampakan = 0;
        $jumlahBau = 0;
        $jumlahRasa = 0;
        $jumlahTekstur = 0;
        $jumlahTotal = 0;



        /*
        JUDUL
        */

        $rows[] = [
            'LAMPIRAN LAPORAN HASIL UJI'
        ];

        $rows[] = [];



        /*
        INFORMASI
        */


        $rows[] = [

            'Tanggal : ' . $this->testSession->tanggal_pengujian,

            '',

            '',

            '',

            'Jenis Produk : ' . $this->testSession->sample->product->nama_produk

        ];



        $rows[] = [

            'Nomor Sample : ' . $this->testSession->sample->nomor_sample

        ];



        $rows[] = [];



        /*
        HEADER
        */


        $rows[] = [

            'No',
            'Panelis',
            'Kenampakan',
            'Bau',
            'Rasa',
            'Tekstur',
            'Jumlah',
            'Rata-rata'

        ];




        foreach ($assessments as $index => $assessment) {


            $nilai = [];



            foreach ($assessment->details as $detail) {

                $nilai[$detail->criteria->nama_kriteria]
                    =
                    $detail->nilai;
            }



            $jumlahKenampakan += $nilai['Kenampakan'] ?? 0;
            $jumlahBau += $nilai['Bau'] ?? 0;
            $jumlahRasa += $nilai['Rasa'] ?? 0;
            $jumlahTekstur += $nilai['Tekstur'] ?? 0;


            $jumlahTotal += $assessment->total_nilai;



            $rows[] = [

                $index + 1,

                $assessment->user->name,

                $nilai['Kenampakan'] ?? '-',

                $nilai['Bau'] ?? '-',

                $nilai['Rasa'] ?? '-',

                $nilai['Tekstur'] ?? '-',

                $assessment->total_nilai,

                number_format(
                    $assessment->nilai_akhir,
                    2
                )

            ];
        }




        $jumlahPanelis = count($assessments);



        $nilaiAkhir =
            $jumlahTotal /
            ($jumlahPanelis * 4);




        /*
        JUMLAH
        */


        $rows[] = [

            '',

            'Jumlah',

            $jumlahKenampakan,

            $jumlahBau,

            $jumlahRasa,

            $jumlahTekstur,

            $jumlahTotal,

            number_format(
                $nilaiAkhir,
                2
            )

        ];





        /*
        Tambahan baris kosong
        */

        for ($i = 0; $i < 12; $i++) {
            $rows[] = array_fill(0, 8, '');
        }




        return $rows;
    }








    public function registerEvents(): array
    {


        return [


            AfterSheet::class => function (AfterSheet $event) {


                $sheet = $event->sheet->getDelegate();




                /*
                FONT
                */


                $sheet
                    ->getStyle('A1:K30')
                    ->getFont()
                    ->setName('Times New Roman');





                /*
                JUDUL
                */


                $sheet->mergeCells('A1:H1');


                $sheet
                    ->getStyle('A1')
                    ->getFont()
                    ->setBold(true)
                    ->setSize(14);



                $sheet
                    ->getStyle('A1')
                    ->getAlignment()
                    ->setHorizontal(
                        Alignment::HORIZONTAL_CENTER
                    );





                /*
                WIDTH
                */


                $width = [

                    'A' => 8,
                    'B' => 20,
                    'C' => 15,
                    'D' => 12,
                    'E' => 12,
                    'F' => 12,
                    'G' => 12,
                    'H' => 14,

                    'J' => 22,
                    'K' => 15

                ];



                foreach ($width as $col => $size) {

                    $sheet
                        ->getColumnDimension($col)
                        ->setWidth($size);
                }




                /*
TABEL
*/


                $jumlahBarisData =
                    5 +
                    $this->testSession->assessments->count();



                // Border mulai dari HEADER sampai JUMLAH

                $sheet
                    ->getStyle(
                        'A4:H' . $jumlahBarisData
                    )
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(
                        Border::BORDER_THIN
                    );



                // Alignment seluruh tabel

                $sheet
                    ->getStyle(
                        'A4:H' . $jumlahBarisData
                    )
                    ->getAlignment()
                    ->setHorizontal(
                        Alignment::HORIZONTAL_CENTER
                    );



                // Header kolom

                $sheet
                    ->getStyle('A4:H4')
                    ->getFont()
                    ->setBold(true);



                // Baris jumlah

                $sheet
                    ->getStyle(
                        'A' . $jumlahBarisData . ':H' . $jumlahBarisData
                    )
                    ->getFont()
                    ->setBold(true);



                // Nama panelis rata kiri

                $sheet
                    ->getStyle(
                        'B5:B' . $jumlahBarisData
                    )
                    ->getAlignment()
                    ->setHorizontal(
                        Alignment::HORIZONTAL_LEFT
                    );



                // Tinggi baris

                for ($i = 4; $i <= $jumlahBarisData; $i++) {

                    $sheet
                        ->getRowDimension($i)
                        ->setRowHeight(22);
                }


                /*
                STATISTIK KANAN
                */


                $sheet->setCellValue('J6', 'Konstanta');
                $sheet->setCellValue('K6', '1.96');


                $sheet->setCellValue(
                    'J7',
                    'n (Jumlah Panelis)'
                );


                $sheet->setCellValue(
                    'K7',
                    $this->testSession->assessments->count()
                );



                $sheet->setCellValue('J8', '√n');

                $sheet->setCellValue(
                    'K8',
                    number_format(
                        sqrt(
                            $this->testSession->assessments->count()
                        ),
                        4
                    )
                );



                $sheet->setCellValue('J9', 'P min');
                $sheet->setCellValue('K9', '-');



                $sheet->setCellValue('J10', 'P max');
                $sheet->setCellValue('K10', '-');



                $sheet->setCellValue(
                    'J11',
                    'P (Skor Akhir Mutu)'
                );



                $sheet->setCellValue(
                    'K11',
                    number_format(
                        $this->testSession->assessments->sum('total_nilai')
                            /
                            ($this->testSession->assessments->count() * 4),
                        2
                    )
                );



                $sheet
                    ->getStyle('J6:K11')
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(
                        Border::BORDER_THIN
                    );








                /*
                NILAI AKHIR MUTU
                */


                $sheet->mergeCells('J14:K14');

                $sheet->setCellValue(
                    'J14',
                    'NILAI AKHIR MUTU (P)'
                );


                $sheet->mergeCells('J15:K15');


                $sheet->setCellValue(
                    'J15',
                    number_format(
                        $this->testSession->assessments->sum('total_nilai')
                            /
                            ($this->testSession->assessments->count() * 4),
                        2
                    )
                );



                $sheet->mergeCells('J16:K16');


                $sheet->setCellValue(
                    'J16',
                    '(DIBULATKAN 0.5)'
                );



                $sheet
                    ->getStyle('J14:K16')
                    ->getAlignment()
                    ->setHorizontal(
                        Alignment::HORIZONTAL_CENTER
                    );







                /*
                TTD
                */


                $sheet->mergeCells('A20:C20');
                $sheet->mergeCells('F20:H20');


                $sheet->setCellValue(
                    'A20',
                    'Penyelia'
                );


                $sheet->setCellValue(
                    'F20',
                    'Analis'
                );



                $sheet->mergeCells('A23:C23');
                $sheet->mergeCells('F23:H23');



                $sheet->setCellValue(
                    'A23',
                    '(...........................)'
                );


                $sheet->setCellValue(
                    'F23',
                    '(...........................)'
                );



                $sheet
                    ->getStyle('A20:H23')
                    ->getAlignment()
                    ->setHorizontal(
                        Alignment::HORIZONTAL_CENTER
                    );







                /*
                PRINT
                */


                $sheet
                    ->getPageSetup()
                    ->setOrientation(
                        PageSetup::ORIENTATION_LANDSCAPE
                    );


                $sheet
                    ->getPageSetup()
                    ->setFitToWidth(1);
            }

        ];
    }
}
