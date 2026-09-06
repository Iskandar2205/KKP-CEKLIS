<x-app-layout>


<div class="
min-h-screen 
bg-gradient-to-b 
from-[#F8FAFC]
via-[#F1F5F9]
to-white
py-10
">


<div class="
max-w-7xl
mx-auto
px-6
">







{{-- HERO SECTION --}}


<div class="
relative
overflow-hidden
rounded-[35px]
shadow-2xl
mb-10
border-t-4
border-[#D4AF37]
">



<div class="
absolute
inset-0
bg-gradient-to-r
from-[#071A33]
via-[#0F172A]
to-[#334155]
">
</div>




<div class="
absolute
right-10
bottom-[-40px]
text-[180px]
opacity-20
text-[#D4AF37]
">
⚓
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
BPPMHKP EXECUTIVE SYSTEM
</p>




<h1 class="
text-5xl
font-black
mt-5
leading-tight
">

Ocean Quality Intelligence

</h1>





<p class="
mt-5
max-w-xl
text-slate-300
leading-relaxed
">

Digital monitoring sistem pengujian mutu
produk kelautan dan perikanan berbasis data
untuk mendukung pengambilan keputusan pimpinan.

</p>






<div class="
flex
gap-8
mt-8
">



<div>

<p class="font-bold">
✓ Data Akurat
</p>

<p class="text-xs text-slate-300">
Quality Control
</p>

</div>




<div>

<p class="font-bold">
✓ Real Time
</p>

<p class="text-xs text-slate-300">
Monitoring
</p>

</div>




<div>

<p class="font-bold">
✓ Digital System
</p>

<p class="text-xs text-slate-300">
Integrated
</p>

</div>



</div>



</div>








<div class="
bg-white/10
backdrop-blur-xl
border
border-[#D4AF37]/40
rounded-3xl
p-6
min-w-[180px]
">



<p class="
text-xs
text-slate-300
">

SYSTEM STATUS

</p>




<div class="
flex
items-center
gap-3
mt-4
">


<div class="
w-3
h-3
rounded-full
bg-[#D4AF37]
animate-pulse
">
</div>


<span class="
font-black
text-[#D4AF37]
">

ONLINE

</span>


</div>


</div>





</div>



</div>



</div>









{{-- EXECUTIVE SUMMARY --}}



<div class="mb-10">


<div class="mb-6">


<h2 class="
text-2xl
font-black
text-slate-800
">

Executive Summary

</h2>


<p class="
text-sm
text-slate-500
">

Ringkasan aktivitas pengujian mutu produk

</p>


</div>







<div class="
grid
grid-cols-2
md:grid-cols-3
lg:grid-cols-6
gap-5
">





@php

$summaryCards = [

[
'label'=>'Total Pengujian',
'value'=>$totalUji,
'color'=>'text-[#071A33]'
],

[
'label'=>'Pengujian Aktif',
'value'=>$ujiAktif,
'color'=>'text-[#D4AF37]'
],

[
'label'=>'Selesai',
'value'=>$ujiSelesai,
'color'=>'text-green-600'
],

[
'label'=>'Produk',
'value'=>$totalProduk,
'color'=>'text-[#0EA5A4]'
],

[
'label'=>'Panelis',
'value'=>$totalPanelis,
'color'=>'text-indigo-600'
],

[
'label'=>'Sample',
'value'=>$totalSampel,
'color'=>'text-purple-600'
]

];


@endphp





@foreach($summaryCards as $card)



<div class="
group
bg-white
rounded-[28px]
shadow-sm
border
border-slate-100
border-t-4
border-[#D4AF37]
p-6
hover:shadow-xl
hover:-translate-y-1
transition
duration-300
">



<p class="
text-sm
text-slate-500
">

{{ $card['label'] }}

</p>




<h2 class="
text-4xl
font-black
mt-4
{{ $card['color'] }}
">

{{ $card['value'] }}

</h2>




<div class="
mt-4
text-xs
text-green-600
">

● Realtime Data

</div>



</div>



@endforeach





</div>


</div>

{{-- QUALITY PERFORMANCE --}}



<div class="
grid
md:grid-cols-2
gap-6
mb-10
">





<div class="
bg-white
rounded-[32px]
shadow-sm
border
border-slate-100
p-8
hover:shadow-xl
transition
">



<h3 class="
text-xl
font-black
text-slate-800
">

Quality Performance

</h3>



<p class="
text-sm
text-slate-500
">

Rata-rata mutu hasil pengujian

</p>





<div class="mt-8">


<h1 class="
text-7xl
font-black
text-[#D4AF37]
">

{{ number_format($nilaiMutu ?? 0,2) }}

</h1>





@if(($nilaiMutu ?? 0)>=7)

<span class="
inline-block
mt-4
px-5
py-2
rounded-full
bg-green-100
text-green-700
font-bold
">

Excellent Quality

</span>


@elseif(($nilaiMutu ?? 0)>=5)

<span class="
inline-block
mt-4
px-5
py-2
rounded-full
bg-yellow-100
text-yellow-700
font-bold
">

Good Quality

</span>


@else

<span class="
inline-block
mt-4
px-5
py-2
rounded-full
bg-red-100
text-red-700
font-bold
">

Need Attention

</span>


@endif



</div>


</div>








<div class="
bg-white
rounded-[32px]
shadow-sm
border
border-slate-100
p-8
">



<h3 class="
text-xl
font-black
text-slate-800
">

System Overview

</h3>




<div class="
mt-8
space-y-5
">



<div class="flex justify-between">

<span class="text-slate-500">
Status
</span>


<b class="text-green-600">
Active
</b>


</div>




<div class="flex justify-between">

<span class="text-slate-500">
Database
</span>


<b>
Connected
</b>


</div>





<div class="flex justify-between">

<span class="text-slate-500">
Monitoring
</span>


<b class="text-[#0EA5A4]">
Realtime
</b>


</div>




</div>



</div>






</div>









{{-- ANALYTICS DASHBOARD --}}



<div class="mb-10">


<div class="mb-6">


<h2 class="
text-2xl
font-black
text-slate-800
">

Analytics Dashboard

</h2>


<p class="
text-sm
text-slate-500
">

Visualisasi performa pengujian mutu

</p>


</div>







<div class="
grid
md:grid-cols-2
gap-6
">





{{-- CHART PENGUJIAN --}}



<div class="
bg-white
rounded-[32px]
shadow-sm
border
border-slate-100
p-8
hover:shadow-xl
transition
">



<div class="
flex
justify-between
items-center
mb-5
">


<div>


<h3 class="
text-lg
font-black
text-slate-800
">

Trend Pengujian

</h3>


<p class="
text-sm
text-slate-500
">

Jumlah pengujian per periode

</p>


</div>


<div class="
px-3
py-1
rounded-full
bg-[#F8F1D7]
text-[#8B6914]
text-xs
font-bold
">

2026

</div>


</div>





<div class="h-72">


<canvas id="chartPengujian"></canvas>


</div>



</div>








{{-- CHART MUTU --}}



<div class="
bg-white
rounded-[32px]
shadow-sm
border
border-slate-100
p-8
hover:shadow-xl
transition
">



<div class="
flex
justify-between
items-center
mb-5
">



<div>


<h3 class="
text-lg
font-black
text-slate-800
">

Quality Performance

</h3>


<p class="
text-sm
text-slate-500
">

Trend nilai mutu produk

</p>


</div>



<div class="
px-3
py-1
rounded-full
bg-green-50
text-green-600
text-xs
font-bold
">

QUALITY

</div>



</div>





<div class="h-72">


<canvas id="chartMutu"></canvas>


</div>



</div>





</div>



</div>








{{-- QUALITY INSIGHT --}}



<div class="
bg-gradient-to-r
from-[#071A33]
via-[#0F172A]
to-[#334155]
rounded-[32px]
shadow-xl
p-8
mb-10
text-white
">



<div class="mb-6">


<h2 class="
text-2xl
font-black
">

Quality Insight

</h2>


<p class="
text-slate-300
text-sm
">

Ringkasan kondisi sistem saat ini

</p>


</div>






<div class="
grid
md:grid-cols-4
gap-5
">





<div class="
bg-white/10
backdrop-blur
rounded-2xl
p-5
border
border-[#D4AF37]/30
">


<p class="text-xs text-slate-300">

TOTAL DATA

</p>


<h3 class="
text-3xl
font-black
mt-3
">

{{ $sessions->count() }}

</h3>


<p class="text-xs mt-2 text-slate-300">

Pengujian tercatat

</p>


</div>







<div class="
bg-white/10
backdrop-blur
rounded-2xl
p-5
border
border-[#D4AF37]/30
">


<p class="text-xs text-slate-300">

PANELIS AKTIF

</p>


<h3 class="
text-3xl
font-black
mt-3
">

{{ $totalPanelis }}

</h3>


<p class="text-xs mt-2 text-slate-300">

Evaluator mutu

</p>


</div>







<div class="
bg-white/10
backdrop-blur
rounded-2xl
p-5
border
border-[#D4AF37]/30
">


<p class="text-xs text-slate-300">

QUALITY SCORE

</p>


<h3 class="
text-3xl
font-black
mt-3
">

{{ number_format($nilaiMutu ?? 0,2) }}

</h3>


<p class="text-xs mt-2 text-slate-300">

Rata-rata mutu

</p>


</div>







<div class="
bg-white/10
backdrop-blur
rounded-2xl
p-5
border
border-[#D4AF37]/30
">


<p class="text-xs text-slate-300">

SYSTEM

</p>


<h3 class="
text-3xl
font-black
mt-3
">

ONLINE

</h3>


<p class="text-xs mt-2 text-green-300">

● Running

</p>


</div>







</div>



</div>









{{-- FILTER MONITORING --}}



<div class="
bg-white
rounded-[32px]
shadow-sm
border
border-slate-100
p-8
mb-10
">





<div class="
flex
justify-between
items-center
mb-6
">



<div>


<h2 class="
text-xl
font-black
text-slate-800
">

Quality Monitoring Filter

</h2>


<p class="
text-sm
text-slate-500
">

Filter data berdasarkan parameter pengujian

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

<form method="GET"
action="{{ route('pimpinan.dashboard') }}">


<div class="
grid
md:grid-cols-4
gap-5
">



<div>

<label class="text-sm text-slate-600">

Produk

</label>


<select
name="produk"

class="
mt-2
w-full
rounded-2xl
border-slate-200
">


<option value="">

Semua Produk

</option>


@foreach($produkList as $produk)


<option value="{{ $produk->id }}">

{{ $produk->nama_produk }}

</option>


@endforeach


</select>


</div>





<div>

<label class="text-sm text-slate-600">

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


<option value="draft">

Draft

</option>


<option value="dibuka">

Berjalan

</option>


<option value="selesai">

Selesai

</option>


</select>


</div>





<div>

<label class="text-sm text-slate-600">

Tanggal Mulai

</label>


<input

type="date"

name="tanggal_mulai"

class="
mt-2
w-full
rounded-2xl
border-slate-200
">


</div>





<div>

<label class="text-sm text-slate-600">

Tanggal Akhir

</label>


<input

type="date"

name="tanggal_selesai"

class="
mt-2
w-full
rounded-2xl
border-slate-200
">


</div>



</div>





<div class="mt-6 flex gap-3">



<button

class="
px-7
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

🔎 Tampilkan Data


</button>




<a

href="{{ route('pimpinan.dashboard') }}"

class="
px-7
py-3
rounded-2xl
bg-slate-100
text-slate-700
font-bold
">

Reset

</a>



</div>


</form>


</div>








{{-- REAL TIME QUALITY MONITORING --}}


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
mb-8
">



<div>


<h2 class="
text-xl
font-black
text-slate-800
">

Real Time Quality Monitoring

</h2>


<p class="
text-sm
text-slate-500
">

Daftar hasil pengujian organoleptik

</p>


</div>



<div class="
px-4
py-2
rounded-full
bg-[#F8F1D7]
text-[#8B6914]
font-bold
text-sm
">


{{ $sessions->count() }} Pengujian


</div>



</div>







<div class="overflow-x-auto">


<table class="w-full">


<thead>


<tr class="
bg-[#071A33]
text-white
text-xs
uppercase
tracking-wider
">


<th class="
text-left
px-5
py-4
rounded-l-xl
">

No

</th>


<th>
Produk
</th>


<th>
Sample
</th>


<th>
Tanggal
</th>


<th>
Panelis
</th>


<th>
Nilai
</th>


<th>
Status
</th>


<th class="rounded-r-xl">
Aksi
</th>


</tr>


</thead>





<tbody>



@foreach($sessions as $index=>$session)


@php

$totalNilai = 0;
$totalAssessment = 0;


foreach($session->assessments as $assessment){

$totalNilai += $assessment->total_nilai;

$totalAssessment++;

}


$nilai = $totalAssessment > 0

? $totalNilai / ($totalAssessment * 4)

: 0;


@endphp






<tr class="
border-b
hover:bg-slate-50
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


<div class="
font-bold
text-slate-800
">

{{ $session->sample->product->nama_produk ?? '-' }}

</div>


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





<td>

{{ $session->tanggal_pengujian }}

</td>





<td>


<div class="
w-9
h-9
rounded-full
bg-indigo-100
text-indigo-700
flex
items-center
justify-center
font-bold
">


{{ $session->assessments->count() }}


</div>


</td>






<td>



@if($nilai >= 7)


<span class="
px-3
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
px-3
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
px-3
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


</td>







<td>


@if($session->status=='dibuka')


<span class="
px-3
py-2
rounded-full
bg-[#F8F1D7]
text-[#8B6914]
text-xs
font-bold
">

● Berjalan

</span>



@elseif($session->status=='selesai')


<span class="
px-3
py-2
rounded-full
bg-green-100
text-green-700
text-xs
font-bold
">

● Selesai

</span>



@else


<span class="
px-3
py-2
rounded-full
bg-slate-100
text-slate-700
text-xs
font-bold
">

Draft

</span>



@endif


</td>






<td>


<div class="flex gap-2">



<a

href="{{ route('pimpinan.test_sessions.show',$session->id) }}"

class="
px-4
py-2
rounded-xl
bg-[#071A33]
text-white
text-xs
font-bold
">

Detail

</a>




<a

href="{{ route('pimpinan.test_sessions.pdf',$session->id) }}"

class="
px-4
py-2
rounded-xl
bg-red-500
text-white
text-xs
font-bold
">

PDF

</a>





<a

href="{{ route('pimpinan.test_sessions.excel',$session->id) }}"

class="
px-4
py-2
rounded-xl
bg-green-600
text-white
text-xs
font-bold
">

Excel

</a>



</div>


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







{{-- CHART SCRIPT --}}


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>


document.addEventListener('DOMContentLoaded', function(){



const pengujianData = JSON.parse(

`{!! json_encode($grafikPengujian) !!}`

);



const mutuData = JSON.parse(

`{!! json_encode($grafikMutu) !!}`

);








new Chart(

document.getElementById('chartPengujian'),

{


type:'bar',


data:{


labels:

pengujianData.map(
item=>item.bulan
),




datasets:[{


label:'Jumlah Pengujian',


data:

pengujianData.map(
item=>item.jumlah
),



backgroundColor:'#D4AF37',

borderRadius:12


}]


},



options:{


responsive:true,

maintainAspectRatio:false,


plugins:{


legend:{


display:false


}


}


}



}

);










new Chart(

document.getElementById('chartMutu'),

{


type:'line',


data:{


labels:

mutuData.map(
item=>item.produk
),



datasets:[{


label:'Nilai Mutu',


data:

mutuData.map(
item=>item.nilai
),



borderColor:'#0EA5A4',

backgroundColor:'rgba(14,165,164,0.15)',


fill:true,


tension:0.4


}]


},



options:{


responsive:true,


maintainAspectRatio:false,


scales:{


y:{


min:0,

max:9


}


}



}


}

);



});



</script>





</x-app-layout>