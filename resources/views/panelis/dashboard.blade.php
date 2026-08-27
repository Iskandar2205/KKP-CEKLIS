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



@forelse($sessions as $session)



<tr>


<td class="border p-3 text-center">

{{ $loop->iteration }}

</td>






<td class="border p-3">

{{ $session->testSession->sample->product->nama_produk }}

</td>






<td class="border p-3">

{{ $session->testSession->sample->nomor_sample }}

</td>






<td class="border p-3">

{{ \Carbon\Carbon::parse(
$session->testSession->tanggal_pengujian
)->format('d-m-Y') }}

</td>







<td class="border p-3 text-center">


<span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-sm">

Dibuka

</span>


</td>








<td class="border p-3 text-center">


<a href="{{ route('panelis.assessment.create',$session->testSession->id) }}"

class="bg-blue-600 text-white px-3 py-1 rounded">

Nilai

</a>


</td>





</tr>





@empty



<tr>


<td colspan="6"

class="border p-5 text-center text-gray-500">


Belum ada pengujian aktif


</td>


</tr>



@endforelse





</tbody>



</table>





</div>


</div>


</div>




</x-app-layout>