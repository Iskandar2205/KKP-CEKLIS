<x-app-layout>


<div class="
min-h-screen
bg-gradient-to-b
from-[#F8FAFC]
via-[#F1F5F9]
to-white
py-10
">


<div class="max-w-7xl mx-auto px-6">





{{-- HERO EXECUTIVE MONITORING --}}


<div class="
relative
overflow-hidden
rounded-[35px]
shadow-2xl
mb-8
border-t-4
border-[#D4AF37]
">



<div class="
absolute inset-0
bg-gradient-to-r
from-[#071A33]
via-[#0F172A]
to-[#334155]
">
</div>




{{-- GOLD GLOW --}}


<div class="
absolute
right-[-100px]
top-[-100px]
w-[400px]
h-[400px]
rounded-full
bg-[#D4AF37]/20
blur-3xl
">
</div>



<div class="
absolute
left-[-80px]
bottom-[-100px]
w-[300px]
h-[300px]
rounded-full
bg-slate-400/20
blur-3xl
">
</div>






{{-- WAVE --}}


<div class="
absolute
bottom-0
left-0
right-0
h-24
opacity-20
">


<svg
class="w-full h-full"
viewBox="0 0 1440 200"
preserveAspectRatio="none">


<path

fill="#D4AF37"

d="
M0,120
C220,20 420,180 720,100
C1000,20 1200,160 1440,70
L1440,200
L0,200
Z
">

</path>


</svg>


</div>






<div class="
relative
p-10
text-white
">


<div class="
flex
justify-between
items-center
">





<div>


<p class="
text-xs
tracking-[7px]
text-[#D4AF37]
font-semibold
">

EXECUTIVE MONITORING SYSTEM

</p>






<h1 class="
text-5xl
font-black
mt-4
">


Quality Monitoring

<span class="
text-[#D4AF37]
">

Center

</span>


</h1>






<p class="
mt-5
text-slate-300
max-w-xl
">


Monitoring hasil pengujian organoleptik
produk kelautan dan perikanan secara realtime.


</p>


</div>









<div class="
bg-white/10
backdrop-blur-xl
rounded-[30px]
p-7
border
border-[#D4AF37]/40
shadow-xl
">



<p class="
text-xs
text-slate-300
font-semibold
">

TOTAL PENGUJIAN

</p>




<h2 class="
text-6xl
font-black
mt-3
">

{{ $sessions->count() }}

</h2>




<div class="
flex
items-center
gap-2
mt-3
">


<span class="
w-3
h-3
rounded-full
bg-[#D4AF37]
animate-pulse
">

</span>



<span class="text-sm">

Realtime Data

</span>



</div>



</div>





</div>



</div>



</div>








{{-- FILTER --}}



<div class="
bg-white
rounded-[32px]
shadow-sm
border
border-slate-100
p-8
mb-8
">



<div class="
flex
justify-between
items-center
mb-6
">



<div>


<h3 class="
text-xl
font-black
text-slate-800
">

Filter Monitoring

</h3>


<p class="
text-sm
text-slate-500
">

Cari data berdasarkan parameter pengujian

</p>


</div>




<span class="
px-4
py-2
rounded-full
bg-[#F8F1D7]
text-[#8B6914]
text-xs
font-bold
">

● LIVE DATA

</span>



</div>

<form method="GET">


<div class="
grid
md:grid-cols-4
gap-5
">



<div>

<label class="
text-sm
text-slate-600
">

Produk

</label>



<select

name="product_id"

class="
mt-2
w-full
rounded-2xl
border-slate-200
">


<option value="">

Semua Produk

</option>



@foreach($products as $product)


<option value="{{ $product->id }}"

@if(request('product_id')==$product->id)

selected

@endif

>


{{ $product->nama_produk }}


</option>


@endforeach



</select>


</div>







<div>

<label class="
text-sm
text-slate-600
">

Status

</label>



<select

name="status"

class="
mt-2
w-full
rounded-2xl
border-slate-200
">


<option value="">

Semua Status

</option>



<option value="draft"

@if(request('status')=='draft')

selected

@endif

>

Draft

</option>





<option value="dibuka"

@if(request('status')=='dibuka')

selected

@endif

>

Berjalan

</option>





<option value="selesai"

@if(request('status')=='selesai')

selected

@endif

>

Selesai

</option>



</select>


</div>







<div>


<label class="
text-sm
text-slate-600
">

Nomor Sample

</label>




<input

type="text"

name="nomor_sample"

value="{{ request('nomor_sample') }}"

placeholder="S008"

class="
mt-2
w-full
rounded-2xl
border-slate-200
">


</div>








<div class="
flex
items-end
gap-3
">



<button

class="
px-6
py-3
rounded-2xl

bg-gradient-to-r

from-[#071A33]

to-[#D4AF37]

text-white

font-bold

shadow-lg

hover:scale-105

transition
">


🔍 Filter


</button>






<a

href="{{ route('pimpinan.monitoring.index') }}"

class="
px-6
py-3
rounded-2xl

bg-slate-100

text-slate-700

font-bold
">


Reset


</a>



</div>



</div>


</form>




</div>









{{-- TABLE MONITORING --}}




<div class="
bg-white
rounded-[32px]
shadow-sm
border
border-slate-100
p-8
">





<div class="
flex
justify-between
items-center
mb-7
">



<div>


<h3 class="
text-xl
font-black
text-slate-800
">

Daftar Hasil Pengujian

</h3>



<p class="
text-sm
text-slate-500
">

Monitoring kualitas produk kelautan dan perikanan

</p>



</div>







<div class="
px-5
py-2
rounded-full

bg-[#F8F1D7]

text-[#8B6914]

font-bold

text-sm
">


{{ $sessions->count() }} Data


</div>




</div>









<div class="overflow-x-auto">



<table class="w-full">





<thead>


<tr class="
bg-[#071A33]

text-white

text-sm
">



<th class="
px-5
py-4
text-left
rounded-l-2xl
">

No

</th>



<th class="text-left">

Produk

</th>



<th class="text-left">

Sample

</th>



<th class="text-left">

Tanggal

</th>



<th class="text-left">

Panelis

</th>



<th class="text-left">

Nilai Mutu

</th>



<th class="text-left">

Status

</th>



<th class="
text-left
rounded-r-2xl
">

Aksi

</th>



</tr>



</thead>









<tbody>





@foreach($sessions as $index=>$session)





@php

$total = 0;

@endphp







@foreach($session->assessments as $assessment)



@php

$total += $assessment->total_nilai;

@endphp



@endforeach







<tr class="
border-b

hover:bg-[#F8F1D7]/30

transition
">






<td class="
px-5
py-5
font-semibold
">


{{ $index+1 }}


</td>









<td>



<p class="
font-bold
text-slate-800
">


{{ $session->sample->product->nama_produk ?? '-' }}


</p>


</td>









<td>


<span class="
px-3
py-1

rounded-full

bg-[#F8F1D7]

text-[#8B6914]

text-xs

font-bold
">


{{ $session->sample->nomor_sample ?? '-' }}


</span>


</td>









<td class="text-slate-600">


{{ $session->tanggal_pengujian }}


</td>









<td>


<div class="
w-10
h-10

rounded-full

bg-indigo-100

text-indigo-700

flex

items-center

justify-center

font-black
">


{{ $session->assessments->count() }}


</div>


</td>









<td>





@if($session->assessments->count()>0)



@php

$nilai = $total /

($session->assessments->count()*4);


@endphp






@if($nilai >= 7)


<span class="
px-4
py-2

rounded-full

bg-green-100

text-green-700

text-xs

font-black
">


{{ number_format($nilai,2) }}


</span>







@elseif($nilai >=5)



<span class="
px-4
py-2

rounded-full

bg-[#F8F1D7]

text-[#8B6914]

text-xs

font-black
">


{{ number_format($nilai,2) }}


</span>





@else



<span class="
px-4
py-2

rounded-full

bg-red-100

text-red-700

text-xs

font-black
">


{{ number_format($nilai,2) }}


</span>





@endif







@else



<span class="
px-4
py-2

rounded-full

bg-slate-100

text-slate-500

text-xs
">


-


</span>



@endif




</td>









<td>




@if($session->status=='selesai')



<span class="
px-4
py-2

rounded-full

bg-green-100

text-green-700

text-xs

font-bold
">


● Selesai


</span>






@elseif($session->status=='dibuka')



<span class="
px-4
py-2

rounded-full

bg-[#F8F1D7]

text-[#8B6914]

text-xs

font-bold
">


● Berjalan


</span>





@else



<span class="
px-4
py-2

rounded-full

bg-slate-100

text-slate-700

text-xs
">


Draft


</span>



@endif



</td>









<td>



<a

href="{{ route(

'pimpinan.test_sessions.show',

$session->id

) }}"



class="
inline-flex
items-center

px-5

py-2

rounded-xl

bg-gradient-to-r

from-[#071A33]

to-[#D4AF37]

text-white

text-xs

font-bold

shadow-md

hover:scale-105

transition
">


👁 Detail


</a>



</td>








</tr>








@endforeach







</tbody>







</table>




</div>







</div>









{{-- FOOTER --}}



<div class="
mt-10

pb-10

flex

justify-between

items-center

text-sm

text-slate-500
">





<div>


<h3 class="
font-black

text-[#071A33]
">


BPPMHKP Lampung


</h3>



<p>

Executive Quality Intelligence System

</p>



</div>







<div class="text-right">


<p>

Executive Monitoring

</p>


<p>

Version 1.0

</p>


</div>





</div>







</div>


</div>




</x-app-layout>