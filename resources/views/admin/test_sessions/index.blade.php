<x-app-layout>


<x-slot name="header">

<div class="flex justify-between items-center">

<div>

<h2 class="text-2xl font-bold text-[#003B5C]">
Testing Workflow Center
</h2>

<p class="text-sm text-gray-500">
Monitoring proses pengujian organoleptik BPPMHKP
</p>

</div>

</div>

</x-slot>





<div class="min-h-screen bg-[#F4FAFC] py-10">


<div class="max-w-7xl mx-auto px-6">





{{-- TITLE + ACTION --}}

<div class="
mb-10
flex
justify-between
items-center
">


<div>


<h1 class="
text-3xl
font-bold
text-[#003B5C]
">

Laboratory Testing Workflow

</h1>


<p class="
text-gray-500
mt-2
">

Kelola perjalanan pengujian dari sampel,
panelis hingga hasil akhir.

</p>


</div>





<a href="{{route('admin.test_sessions.create')}}"

class="
bg-[#F7941D]
text-white
px-6
py-3
rounded-xl
font-semibold
shadow-md
hover:bg-orange-500
transition
flex
items-center
gap-2
">


<span class="text-xl">
+
</span>


Buat Pengujian


</a>


</div>









{{-- STATUS WORKFLOW --}}


<div class="
grid
grid-cols-1
md:grid-cols-3
gap-6
mb-10
">



<div class="
bg-white
rounded-3xl
p-6
border-l-8
border-[#0077B6]
shadow-sm
">


<p class="text-gray-400 text-sm uppercase">
Draft
</p>


<h1 class="
text-5xl
font-bold
text-[#003B5C]
mt-3
">

{{ $sessions->where('status','draft')->count() }}

</h1>


<p class="text-gray-500 mt-2">
Persiapan pengujian
</p>


</div>








<div class="
bg-white
rounded-3xl
p-6
border-l-8
border-[#00A896]
shadow-sm
">


<p class="text-gray-400 text-sm uppercase">
Active Test
</p>


<h1 class="
text-5xl
font-bold
text-[#00A896]
mt-3
">

{{ $sessions->where('status','dibuka')->count() }}

</h1>


<p class="text-gray-500 mt-2">
Sedang berjalan
</p>


</div>








<div class="
bg-[#003B5C]
rounded-3xl
p-6
text-white
">


<p class="text-blue-200 text-sm uppercase">
Completed
</p>


<h1 class="
text-5xl
font-bold
mt-3
">

{{ $sessions->where('status','selesai')->count() }}

</h1>


<p class="text-blue-200 mt-2">
Pengujian selesai
</p>


</div>



</div>









{{-- CURRENT ACTIVE TEST --}}


@php

$active =
$sessions->where('status','dibuka')->first();

@endphp






<div class="
bg-gradient-to-r
from-[#002B45]
to-[#0077B6]
rounded-3xl
p-8
text-white
mb-10
shadow-lg
">


<h2 class="
text-xl
font-bold
mb-6
">

Current Active Testing

</h2>




@if($active)



<div class="
grid
grid-cols-1
md:grid-cols-3
gap-6
">



<div>

<p class="text-blue-200 text-sm">
Produk
</p>


<h3 class="
text-2xl
font-bold
mt-2
">

{{$active->sample->product->nama_produk ?? '-'}}

</h3>


</div>





<div>

<p class="text-blue-200 text-sm">
Kode Sample
</p>


<h3 class="
text-2xl
font-bold
mt-2
">

{{$active->sample->kode_sample ?? '-'}}

</h3>


</div>





<div>

<p class="text-blue-200 text-sm">
Tanggal
</p>


<h3 class="
text-xl
font-bold
mt-2
">

{{date('d M Y',strtotime($active->tanggal_pengujian))}}

</h3>


</div>



</div>







<div class="
mt-8
bg-white/10
rounded-2xl
p-5
">


<p class="text-blue-100 text-sm">
Panelis Terlibat
</p>


<div class="
flex
flex-wrap
gap-3
mt-4
">


@foreach($active->sessionUsers as $user)


<span class="
bg-white/20
px-4
py-2
rounded-full
text-sm
">

{{$user->nama}}

</span>


@endforeach


</div>


</div>





@else


<div class="text-blue-100">

Tidak ada pengujian aktif saat ini.

</div>


@endif



</div>









{{-- TIMELINE --}}



<div class="
bg-white
rounded-3xl
p-8
shadow-sm
">


<h2 class="
text-xl
font-bold
text-[#003B5C]
mb-8
">

Testing Timeline

</h2>






<div class="space-y-6">





@forelse($sessions as $session)



<div class="
flex
gap-6
items-start
">





<div class="
w-16
h-16
rounded-2xl
bg-[#E7F7FA]
flex
items-center
justify-center
font-bold
text-[#0077B6]
">


{{date('d',strtotime($session->tanggal_pengujian))}}


</div>








<div class="
flex-1
border-b
pb-6
">



<div class="
flex
justify-between
items-start
">


<div>


<h3 class="
text-lg
font-bold
text-[#003B5C]
">

{{$session->sample->product->nama_produk ?? '-'}}

</h3>


<p class="text-gray-500">

Sample:
{{$session->sample->kode_sample ?? '-'}}

</p>


</div>







@if($session->status=='dibuka')

<span class="
bg-green-100
text-green-700
px-4
py-2
rounded-full
text-sm
">

ACTIVE

</span>


@elseif($session->status=='selesai')


<span class="
bg-gray-200
text-gray-700
px-4
py-2
rounded-full
text-sm
">

SELESAI

</span>


@else


<span class="
bg-blue-100
text-blue-700
px-4
py-2
rounded-full
text-sm
">

DRAFT

</span>


@endif



</div>







<div class="mt-4 flex gap-3">



<a href="{{route('admin.test_sessions.show',$session)}}"

class="
bg-[#0077B6]
text-white
px-4
py-2
rounded-lg
text-sm
">

Detail

</a>




<a href="{{route('admin.test_sessions.edit',$session)}}"

class="
bg-[#003B5C]
text-white
px-4
py-2
rounded-lg
text-sm
">

Edit

</a>




</div>




</div>




</div>




@empty


<div class="
text-center
py-10
text-gray-400
">

Belum ada sesi pengujian

</div>



@endforelse





</div>





</div>








</div>


</div>


</x-app-layout>