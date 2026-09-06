<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<title>Laporan Hasil Uji</title>


<style>

body {

    font-family: Arial, sans-serif;
    font-size: 12px;

}


.title {

    text-align:center;
    font-size:16px;
    font-weight:bold;
    margin-bottom:20px;

}



.info {

    margin-bottom:15px;

}



.result-table {

    width:100%;
    border-collapse:collapse;

}



.result-table th {

    background:#eeeeee;
    font-weight:bold;
    border:1px solid black;
    padding:6px;
    text-align:center;

}



.result-table td {

    border:1px solid black;
    padding:6px;
    text-align:center;

}



.left {

    text-align:left;

}



.mutu {

    margin-top:35px;
    text-align:center;
    font-size:16px;
    font-weight:bold;

}



/* ===========================
   TANDA TANGAN TANPA BORDER
   =========================== */


.signature-container {

    margin-top:90px;
    width:100%;
    height:120px;

}



.signature-left {

    width:50%;
    float:left;
    text-align:center;

}



.signature-right {

    width:50%;
    float:right;
    text-align:center;

}



</style>


</head>



<body>



<div class="title">

LAMPIRAN LAPORAN HASIL UJI

</div>





<div class="info">


Tanggal :
{{ $testSession->tanggal_pengujian }}

<br>


Nomor Sample :
{{ $testSession->sample->nomor_sample }}


<br>


Jenis Produk :
{{ $testSession->sample->product->nama_produk }}


</div>







<table class="result-table">


<tr>

<th>No</th>

<th>Panelis</th>

<th>Kenampakan</th>

<th>Bau</th>

<th>Rasa</th>

<th>Tekstur</th>

<th>Jumlah</th>

<th>Rata-rata</th>

</tr>






@php

$total = 0;

$kenampakan = 0;

$bau = 0;

$rasa = 0;

$tekstur = 0;

@endphp







@foreach($testSession->assessments as $index=>$assessment)



@php


$data=[];


foreach($assessment->details as $detail)

{

    $data[$detail->criteria->nama_kriteria]
    =
    $detail->nilai;

}



$kenampakan += $data['Kenampakan'] ?? 0;

$bau += $data['Bau'] ?? 0;

$rasa += $data['Rasa'] ?? 0;

$tekstur += $data['Tekstur'] ?? 0;


$total += $assessment->total_nilai;



@endphp






<tr>


<td>

{{ $index+1 }}

</td>



<td class="left">

{{ $assessment->user->name }}

</td>




<td>

{{ $data['Kenampakan'] ?? '-' }}

</td>




<td>

{{ $data['Bau'] ?? '-' }}

</td>




<td>

{{ $data['Rasa'] ?? '-' }}

</td>




<td>

{{ $data['Tekstur'] ?? '-' }}

</td>




<td>

{{ $assessment->total_nilai }}

</td>




<td>

{{ number_format($assessment->nilai_akhir,2) }}

</td>



</tr>




@endforeach







<tr>


<td colspan="2">

<b>Jumlah</b>

</td>



<td>

{{ $kenampakan }}

</td>



<td>

{{ $bau }}

</td>



<td>

{{ $rasa }}

</td>



<td>

{{ $tekstur }}

</td>



<td>

{{ $total }}

</td>



<td>

{{ number_format($total/($testSession->assessments->count()*4),2) }}

</td>


</tr>



</table>








<div class="mutu">


NILAI AKHIR MUTU (P)


<br><br>


{{ number_format($total/($testSession->assessments->count()*4),2) }}


<br>


(DIBULATKAN 0.5)


</div>







<div class="signature-container">


<div class="signature-left">


Penyelia


<br><br><br><br>


(........................)


</div>





<div class="signature-right">


Analis


<br><br><br><br>


(........................)


</div>



</div>






</body>

</html>