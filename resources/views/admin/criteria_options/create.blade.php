<x-app-layout>


<x-slot name="header">

<h2 class="font-semibold text-xl text-gray-800">

Tambah Skala Penilaian

</h2>

</x-slot>





<div class="py-12">


<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


<div class="bg-white shadow-sm rounded-lg p-6">



<form action="{{ route('admin.criteria_options.store') }}"

method="POST">


@csrf





<div class="mb-4">


<label class="block font-medium mb-2">

Nilai

</label>



<input type="number"

name="nilai"

class="w-full border rounded p-2">



</div>







<div class="mb-4">


<label class="block font-medium mb-2">

Deskripsi

</label>



<input type="text"

name="deskripsi"

placeholder="Contoh: Sangat Baik"

class="w-full border rounded p-2">



</div>






<button class="bg-green-600 text-white px-4 py-2 rounded">

Simpan

</button>




<a href="{{ route('admin.criteria_options.index') }}"

class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">

Kembali

</a>




</form>



</div>


</div>


</div>


</x-app-layout>