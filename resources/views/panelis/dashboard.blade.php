<x-app-layout>


<x-slot name="header">

<h2 class="font-semibold text-xl text-gray-800">

Dashboard Panelis

</h2>

</x-slot>





<div class="py-12">


<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


<div class="bg-white shadow-sm rounded-lg p-6">





<h3 class="text-lg font-bold mb-5">

Pengujian Aktif

</h3>






<table class="w-full border-collapse border">


<thead>


<tr class="bg-gray-100">


<th class="border p-3">
No
</th>


<th class="border p-3">
Produk
</th>


<th class="border p-3">
Sample
</th>


<th class="border p-3">
Tanggal Pengujian
</th>


<th class="border p-3">
Status
</th>


<th class="border p-3">
Aksi
</th>


</tr>


</thead>





<tbody>

@if($sessions->count() > 0)

@foreach($sessions as $index=>$session)

<tr>

<td>
{{ $index+1 }}
</td>


<td>
{{ $session->testSession->sample->product->nama_produk }}
</td>


<td>
{{ $session->testSession->sample->nomor_sample }}
</td>


<td>
{{ $session->testSession->tanggal_pengujian }}
</td>


<td>
{{ $session->testSession->status }}
</td>


<td>

<a 
href="{{ route(
    'panelis.assessment.create',
    $session->testSession->id
) }}"

class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700">

Nilai

</a>

</td>

</td>


</tr>


@endforeach


@else

<tr>

<td colspan="6"
class="text-center">

Belum ada pengujian aktif

</td>

</tr>

@endif


</tbody>



</table>





</div>


</div>


</div>




</x-app-layout>