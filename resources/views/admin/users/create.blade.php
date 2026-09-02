<x-app-layout>


<x-slot name="header">

<h2 class="font-semibold text-xl text-gray-800">

Tambah User

</h2>

</x-slot>





<div class="py-12">


<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


<div class="bg-white shadow-sm rounded-lg p-6">





<form action="{{ route('admin.users.store') }}"
      method="POST">


@csrf





{{-- Nama --}}

<div class="mb-4">


<label class="block font-medium mb-2">

Nama

</label>


<input type="text"

name="name"

class="w-full border rounded p-2"

placeholder="Masukkan nama user">


</div>








{{-- Username --}}

<div class="mb-4">


<label class="block font-medium mb-2">

Username

</label>


<input type="text"

name="username"

class="w-full border rounded p-2"

placeholder="Masukkan username">


</div>








{{-- Email --}}

<div class="mb-4">


<label class="block font-medium mb-2">

Email

</label>


<input type="email"

name="email"

class="w-full border rounded p-2"

placeholder="contoh@gmail.com">


</div>








{{-- Password --}}

<div class="mb-4">


<label class="block font-medium mb-2">

Password

</label>


<input type="password"

name="password"

class="w-full border rounded p-2"

placeholder="Password">


</div>








{{-- Role --}}

<div class="mb-4">


<label class="block font-medium mb-2">

Role

</label>


<select name="role"

class="w-full border rounded p-2">


<option value="">

-- Pilih Role --

</option>


<option value="admin">

Admin

</option>


<option value="panelis">

Panelis

</option>


<option value="penyelia">

Penyelia

</option>


<option value="analis">

Analis

</option>


<option value="pimpinan">

Pimpinan

</option>


</select>


</div>








{{-- Status --}}

<div class="mb-6">


<label class="block font-medium mb-2">

Status

</label>


<select name="status"

class="w-full border rounded p-2">


<option value="aktif">

Aktif

</option>


<option value="nonaktif">

Nonaktif

</option>


</select>


</div>








<button type="submit"

class="bg-green-600 text-white px-4 py-2 rounded">


Simpan User


</button>





<a href="{{ route('admin.users.index') }}"

class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">


Kembali


</a>





</form>




</div>


</div>


</div>



</x-app-layout>