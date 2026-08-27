<x-app-layout>


<x-slot name="header">

<h2 class="font-semibold text-xl text-gray-800">

Penilaian Organoleptik

</h2>

</x-slot>





<div class="py-12">


<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


<div class="bg-white shadow rounded-lg p-6">





<h3 class="text-lg font-bold mb-5">

{{ $testSession->sample->product->nama_produk }}

</h3>





<table class="mb-6">


<tr>

<td class="font-bold pr-5">

Sample

</td>


<td>

{{ $testSession->sample->nomor_sample }}

</td>


</tr>




<tr>

<td class="font-bold pr-5">

Tanggal Pengujian

</td>


<td>

{{ $testSession->tanggal_pengujian }}

</td>


</tr>



</table>







<form action="{{ route('panelis.assessment.store',$testSession->id) }}"

method="POST">


@csrf





<h3 class="font-bold mb-4">

Form Penilaian

</h3>






@foreach($criteria as $item)


<div class="mb-6 border rounded p-4">


<label class="block font-semibold mb-3">

{{ $item->nama_kriteria }}

</label>





<div class="flex gap-4">


@foreach([1,3,5,6,7,8,9] as $nilai)


<label>


<input type="radio"

name="nilai[{{ $item->id }}]"

value="{{ $nilai }}"

required>


{{ $nilai }}


</label>



@endforeach



</div>



</div>



@endforeach







<button

class="bg-green-600 text-white px-5 py-2 rounded">


Simpan Penilaian


</button>




<a href="{{ route('panelis.dashboard') }}"

class="ml-2 bg-gray-500 text-white px-5 py-2 rounded">

Kembali

</a>





</form>



</div>


</div>


</div>



</x-app-layout>