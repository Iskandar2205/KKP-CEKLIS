<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<title>Laporan Hasil Uji</title>


<style>

body {
    font-family: Arial, sans-serif;
    font-size:12px;
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
    border:1px solid black;
    padding:5px;
    text-align:center;

}


.result-table td {

    border:1px solid black;
    padding:5px;
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



.signature-container {

    margin-top:90px;
    width:100%;

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
{{ optional($testSession->sample)->nomor_sample }}

<br>

Jenis Produk :
{{ optional(optional($testSession->sample)->product)->nama_produk }}


</div>





@php


$criterias = 
optional($testSession->assessmentTemplate)
->criterias ?? collect();



$total = 0;


$jumlahCriteria = $criterias->count();



$jumlahParameter=[];



foreach($criterias as $criteria)
{

    $jumlahParameter[$criteria->nama_kriteria]=0;

}



@endphp





<table class="result-table">


<tr>


<th>No</th>


<th>Panelis</th>



@foreach($criterias as $criteria)


<th>
{{ $criteria->nama_kriteria }}
</th>


@endforeach



<th>Jumlah</th>


<th>Rata-rata</th>


</tr>






@foreach($testSession->assessments as $index=>$assessment)


@php


$data=[];


foreach($assessment->details as $detail)
{

   $data[
    $detail->criteria_id
]
=
$detail->nilai;

}



$jumlah=0;


@endphp




<tr>


<td>
{{ $index+1 }}
</td>



<td class="left">

{{ optional($assessment->user)->name }}

</td>




@foreach($criterias as $criteria)


@php

$nilai =
$data[$criteria->id] ?? 0;


$jumlah += $nilai;


$jumlahParameter[$criteria->nama_kriteria]
+=
$nilai;


@endphp



<td>

{{ $nilai }}

</td>


@endforeach





<td>

{{ $jumlah }}

</td>



<td>

{{

$jumlahCriteria > 0

?

number_format(
$jumlah/$jumlahCriteria,
2
)

:

0

}}


</td>



</tr>



@php

$total += $jumlah;

@endphp



@endforeach







<tr>


<td colspan="2">

<b>Jumlah</b>

</td>




@foreach($criterias as $criteria)


<td>

{{

$jumlahParameter[$criteria->nama_kriteria]

}}


</td>



@endforeach





<td>

{{ $total }}

</td>



<td>


{{

number_format(
optional($testSession->testResult)
->rata_rata_produk ?? 0,
2

)

}}



</td>


</tr>



</table>





<br><br>





<table class="result-table">


<tr>

<th colspan="2">
PERHITUNGAN NILAI MUTU
</th>

</tr>




<tr>

<td class="left">
Jumlah Panelis (n)
</td>

<td>
{{ optional($testSession->testResult)->jumlah_panelis ?? 0 }}
</td>

</tr>




<tr>

<td class="left">
Jumlah Parameter
</td>

<td>
{{ optional($testSession->testResult)->jumlah_parameter ?? 0 }}
</td>

</tr>




<tr>

<td class="left">
Konstanta (Z)
</td>

<td>
{{ number_format(optional($testSession->testResult)->z_score ?? 0,3) }}
</td>

</tr>




<tr>

<td class="left">
√n
</td>

<td>
{{ number_format(optional($testSession->testResult)->akar_n ?? 0,3) }}
</td>

</tr>




<tr>

<td class="left">
Varians (s²)
</td>

<td>
{{ number_format(optional($testSession->testResult)->varians ?? 0,3) }}
</td>

</tr>




<tr>

<td class="left">
Standar Deviasi (s)
</td>

<td>
{{ number_format(optional($testSession->testResult)->standar_deviasi ?? 0,3) }}
</td>

</tr>




<tr>

<td class="left">
Error
</td>

<td>
{{ number_format(optional($testSession->testResult)->error ?? 0,3) }}
</td>

</tr>




<tr>

<td class="left">
P Minimum
</td>

<td>
{{ number_format(optional($testSession->testResult)->p_min ?? 0,3) }}
</td>

</tr>




<tr>

<td class="left">
P Maximum
</td>

<td>
{{ number_format(optional($testSession->testResult)->p_max ?? 0,3) }}
</td>

</tr>



</table>




<br><br>




<div class="mutu">


NILAI AKHIR MUTU (P)


<br><br>



{{

number_format(

optional($testSession->testResult)
->nilai_mutu ?? 0,

2

)

}}




<br>


(DIBULATKAN 0.5)



<br><br>



Kategori :

{{

optional($testSession->testResult)
->kategori ?? '-'

}}



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