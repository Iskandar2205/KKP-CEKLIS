
<x-app-layout>


<x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800">

        Manajemen User

    </h2>

</x-slot>





<div class="py-12">


<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


<div class="bg-white shadow-sm rounded-lg p-6">





<div class="flex justify-between mb-6">


<h3 class="text-xl font-bold">

Daftar User

</h3>




<a href="{{ route('admin.users.create') }}"

class="bg-blue-600 text-white px-4 py-2 rounded">


+ Tambah User


</a>



</div>







@if(session('success'))


<div class="bg-green-100 text-green-700 p-3 rounded mb-4">


{{ session('success') }}


</div>


@endif







<table class="w-full border-collapse border">


<thead>


<tr class="bg-gray-100">


<th class="border p-3">

No

</th>


<th class="border p-3">

Nama

</th>


<th class="border p-3">

Username

</th>


<th class="border p-3">

Email

</th>


<th class="border p-3">

Role

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


@forelse($users as $user)


<tr>


<td class="border p-3">

{{ $loop->iteration }}

</td>



<td class="border p-3">

{{ $user->name }}

</td>



<td class="border p-3">

{{ $user->username }}

</td>



<td class="border p-3">

{{ $user->email }}

</td>



<td class="border p-3">

{{ ucfirst($user->role) }}

</td>



<td class="border p-3">


@if($user->status == 'aktif')


<span class="bg-green-200 text-green-800 px-3 py-1 rounded">

Aktif

</span>


@else


<span class="bg-red-200 text-red-800 px-3 py-1 rounded">

Nonaktif

</span>


@endif


</td>





<td class="border p-3">


<a href="{{ route('admin.users.edit',$user->id) }}"

class="bg-yellow-500 text-white px-3 py-1 rounded">


Edit


</a>






<form action="{{ route('admin.users.destroy',$user->id) }}"

method="POST"

class="inline">


@csrf

@method('DELETE')


<button onclick="return confirm('Hapus user ini?')"

class="bg-red-600 text-white px-3 py-1 rounded">


Hapus


</button>


</form>



</td>



</tr>


@empty


<tr>

<td colspan="7"

class="border p-4 text-center">


Belum ada user


</td>

</tr>


@endforelse



</tbody>


</table>






</div>


</div>


</div>



</x-app-layout>