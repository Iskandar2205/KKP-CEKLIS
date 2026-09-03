<x-app-layout>


<x-slot name="header">

<h2 class="font-semibold text-xl text-gray-800">
Hasil Pengujian Organoleptik
</h2>

</x-slot>



<div class="py-10">

<div class="max-w-7xl mx-auto px-6">


<div class="bg-white rounded-xl shadow p-6">


<h1 class="text-2xl font-bold mb-4">
{{ $testSession->sample->product->nama_produk }}
</h1>


<p>
Nomor Sample :
{{ $testSession->sample->nomor_sample }}
</p>


<p>
Tanggal :
{{ $testSession->tanggal_pengujian }}
</p>



<hr class="my-6">



<table class="w-full border">


<thead>

<tr class="bg-gray-100">

<th class="border p-2">
No
</th>

<th class="border p-2">
Panelis
</th>

<th class="border p-2">
Total Nilai
</th>

<th class="border p-2">
Nilai Akhir
</th>

</tr>

</thead>



<tbody>


@foreach($testSession->assessments as $index=>$assessment)


<tr>

<td class="border p-2 text-center">
{{ $index+1 }}
</td>


<td class="border p-2">
{{ $assessment->user->name }}
</td>


<td class="border p-2 text-center">
{{ $assessment->total_nilai }}
</td>


<td class="border p-2 text-center">
{{ $assessment->nilai_akhir }}
</td>


</tr>


@endforeach


</tbody>


</table>


</div>


</div>


</div>


</x-app-layout>