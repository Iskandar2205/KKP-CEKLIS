<x-app-layout>


<x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        Detail Hasil Pengujian

    </h2>

</x-slot>





<div class="py-12">


<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">





<!-- INFORMASI SAMPLE -->

<div class="bg-white shadow rounded-lg p-6 mb-6">


<h3 class="text-lg font-bold mb-5">

Informasi Pengujian

</h3>



<div class="grid grid-cols-2 gap-4">


<div>

<p class="text-gray-500">
Produk
</p>

<p class="font-bold">

{{ $testSession->sample->product->nama_produk }}

</p>

</div>





<div>

<p class="text-gray-500">
Nomor Sample
</p>

<p class="font-bold">

{{ $testSession->sample->nomor_sample }}

</p>

</div>





<div>

<p class="text-gray-500">
Tanggal Pengujian
</p>

<p class="font-bold">

{{ $testSession->tanggal_pengujian }}

</p>

</div>





<div>

<p class="text-gray-500">
Status
</p>


@if($testSession->status == 'selesai')

<span class="px-3 py-1 bg-green-100 text-green-700 rounded">

Selesai

</span>


@elseif($testSession->status == 'dibuka')


<span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded">

Berjalan

</span>


@else

<span class="px-3 py-1 bg-gray-100 text-gray-700 rounded">

Draft

</span>

@endif


</div>


</div>


</div>









<!-- NILAI AKHIR -->

<div class="bg-white shadow rounded-lg p-6 mb-6">


<h3 class="text-lg font-bold mb-5">

Hasil Akhir Pengujian

</h3>



<div class="grid grid-cols-3 gap-6">



<div>

<p class="text-gray-500">
Jumlah Panelis
</p>

<p class="text-3xl font-bold text-blue-600">

{{ $jumlahPanelis }}

</p>

</div>




<div>

<p class="text-gray-500">
Nilai Mutu
</p>

<p class="text-3xl font-bold text-green-600">

{{ number_format($nilaiMutu,2) }}

</p>

</div>





<div>

<p class="text-gray-500">
Status
</p>

<p class="font-bold">

{{ ucfirst($testSession->status) }}

</p>

</div>



</div>


</div>









<!-- DETAIL PENILAIAN -->

<div class="bg-white shadow rounded-lg p-6">


<h3 class="text-lg font-bold mb-5">

Detail Penilaian Panelis

</h3>





<div class="overflow-x-auto">


<table class="min-w-full border">


<thead class="bg-gray-100">


<tr>


<th class="border px-4 py-2">
No
</th>


<th class="border px-4 py-2">
Panelis
</th>


<th class="border px-4 py-2">
Kenampakan
</th>


<th class="border px-4 py-2">
Bau
</th>


<th class="border px-4 py-2">
Rasa
</th>


<th class="border px-4 py-2">
Tekstur
</th>


<th class="border px-4 py-2">
Jumlah
</th>


<th class="border px-4 py-2">
Rata-rata
</th>


</tr>


</thead>





<tbody>


@foreach($testSession->assessments as $index=>$assessment)



@php

$data=[];


foreach($assessment->details as $detail)

{

$data[$detail->criteria->nama_kriteria] = $detail->nilai;

}


@endphp





<tr>


<td class="border px-4 py-2 text-center">

{{ $index+1 }}

</td>




<td class="border px-4 py-2">

{{ $assessment->user->name }}

</td>




<td class="border px-4 py-2 text-center">

{{ $data['Kenampakan'] ?? '-' }}

</td>




<td class="border px-4 py-2 text-center">

{{ $data['Bau'] ?? '-' }}

</td>




<td class="border px-4 py-2 text-center">

{{ $data['Rasa'] ?? '-' }}

</td>




<td class="border px-4 py-2 text-center">

{{ $data['Tekstur'] ?? '-' }}

</td>




<td class="border px-4 py-2 text-center">

{{ $assessment->total_nilai }}

</td>




<td class="border px-4 py-2 text-center">

{{ number_format($assessment->nilai_akhir,2) }}

</td>



</tr>



@endforeach



</tbody>


</table>


</div>


</div>









<!-- BUTTON -->

<div class="mt-6">


<a href="{{ route('pimpinan.dashboard') }}"

class="px-5 py-3 bg-gray-700 text-white rounded">


Kembali


</a>



</div>





</div>


</div>



</x-app-layout>