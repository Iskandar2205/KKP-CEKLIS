<x-app-layout>


<div class="
min-h-screen
bg-[#F6FBFC]
py-10
">


<div class="
max-w-7xl
mx-auto
px-6
">



{{-- HERO --}}


<div class="
relative
overflow-hidden
rounded-[35px]
bg-gradient-to-r
from-[#064E3B]
via-[#0F766E]
to-[#14B8A6]
shadow-xl
p-10
mb-8
">



<div class="
absolute
right-[-80px]
top-[-80px]
w-[300px]
h-[300px]
rounded-full
bg-white/10
">
</div>



<div class="
absolute
bottom-[-80px]
left-20
w-[200px]
h-[200px]
rounded-full
bg-yellow-300/10
">
</div>





<div class="
relative
flex
justify-between
items-center
">


<div>


<p class="
text-xs
tracking-[6px]
text-teal-100
font-bold
">

ORGANOLEPTIC ASSESSMENT

</p>



<h1 class="
text-4xl
font-black
text-white
mt-4
">

Assessment Workspace

</h1>



<p class="
mt-4
max-w-xl
text-teal-50
">

Ruang kerja panelis untuk melakukan
penilaian mutu produk kelautan dan perikanan
secara objektif dan terukur.

</p>




<div class="
mt-6
flex
gap-4
">


<span class="
px-4
py-2
rounded-full
bg-white/20
text-white
text-sm
">

🧪 Quality Test

</span>



<span class="
px-4
py-2
rounded-full
bg-white/20
text-white
text-sm
">

⚡ Realtime

</span>



</div>


</div>








<div class="
bg-white/20
backdrop-blur-xl
rounded-3xl
border
border-white/30
p-8
text-center
">


<p class="
text-teal-100
text-sm
font-bold
">

PENDING TASK

</p>



<h2 class="
text-6xl
font-black
text-white
mt-2
">

{{ $sessions->count() }}

</h2>



<p class="
text-white/80
mt-2
">

Sampel Menunggu Nilai

</p>



</div>



</div>



</div>









{{-- INSIGHT CARD --}}



<div class="
grid
md:grid-cols-3
gap-6
mb-8
">





<div class="
bg-white
rounded-3xl
border
border-slate-100
shadow-sm
p-6
">


<div class="text-3xl">
🧪
</div>


<p class="
mt-4
text-sm
text-slate-500
">

Sampel Aktif

</p>


<h2 class="
text-4xl
font-black
text-teal-600
">

{{ $sessions->count() }}

</h2>


</div>






<div class="
bg-white
rounded-3xl
border
border-slate-100
shadow-sm
p-6
">


<div class="text-3xl">
📋
</div>


<p class="
mt-4
text-sm
text-slate-500
">

Parameter Penilaian

</p>


<h2 class="
text-4xl
font-black
text-blue-600
">

6

</h2>


</div>







<div class="
bg-white
rounded-3xl
border
border-slate-100
shadow-sm
p-6
">


<div class="text-3xl">
🏆
</div>


<p class="
mt-4
text-sm
text-slate-500
">

Status Panelis

</p>


<h2 class="
text-3xl
font-black
text-green-600
">

AKTIF

</h2>


</div>



</div>









{{-- TASK SECTION --}}



<div class="
bg-white
rounded-[35px]
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
mb-7
">


<div>


<h2 class="
text-2xl
font-black
text-slate-800
">

Today's Assessment Task

</h2>


<p class="
text-sm
text-slate-500
">

Sampel yang membutuhkan penilaian Anda

</p>


</div>




<div class="
px-5
py-2
rounded-full
bg-teal-50
text-teal-700
font-bold
text-sm
">

{{ $sessions->count() }} Tugas

</div>



</div>









@if($sessions->count()>0)



<div class="
grid
md:grid-cols-2
gap-6
">



@foreach($sessions as $session)



<div class="
rounded-[30px]
border
border-slate-100
p-7
hover:shadow-xl
hover:-translate-y-1
transition
">






<div class="
flex
justify-between
items-start
mb-6
">





<div>


<h3 class="
text-xl
font-black
text-slate-800
">

{{ $session->testSession->sample->product->nama_produk ?? '-' }}

</h3>




<div class="
mt-3
space-y-2
">


<p class="
text-sm
text-slate-500
">

Kode Sampel:

<span class="
font-bold
text-blue-600
">

{{ $session->testSession->sample->nomor_sample ?? '-' }}

</span>


</p>





<p class="
text-sm
text-slate-500
">

Tanggal:

<span class="font-semibold">

{{ $session->testSession->tanggal_pengujian }}

</span>


</p>




<p class="
text-sm
text-slate-500
">

Parameter:

<span class="
font-semibold
text-teal-600
">

6 Komponen Organoleptik

</span>


</p>



</div>


</div>








<div class="
flex
items-center
gap-2
px-4
py-2
rounded-full
bg-amber-50
border
border-amber-200
text-amber-700
text-sm
font-bold
">

<span class="
w-2
h-2
rounded-full
bg-amber-400
animate-pulse
">

</span>


Menunggu Penilaian


</div>




</div>









<div class="
flex
justify-end
">




<a

href="{{ route(
'panelis.assessment.create',
$session->testSession->id
) }}"


class="
inline-flex
items-center
gap-2
px-7
py-3
rounded-2xl
bg-gradient-to-r
from-teal-600
to-cyan-500
text-white
font-bold
shadow-lg
hover:shadow-xl
hover:-translate-y-1
transition
">


🧪 Mulai Penilaian


</a>



</div>





</div>





@endforeach



</div>




@else



<div class="
text-center
py-10
text-slate-500
">

Tidak ada tugas penilaian saat ini

</div>



@endif



</div>









{{-- GUIDE --}}



<div class="
bg-gradient-to-r
from-teal-50
to-blue-50
rounded-3xl
border
border-teal-100
p-7
">



<h3 class="
font-black
text-xl
text-slate-800
mb-5
">

💡 Panduan Panelis

</h3>





<div class="
grid
md:grid-cols-3
gap-6
">



<div>


<p class="
font-bold
text-teal-700
">

01. Periksa Sampel

</p>


<p class="
text-sm
text-slate-500
">

Pastikan kode sampel sesuai.

</p>


</div>






<div>


<p class="
font-bold
text-teal-700
">

02. Berikan Nilai

</p>


<p class="
text-sm
text-slate-500
">

Gunakan parameter organoleptik.

</p>


</div>






<div>


<p class="
font-bold
text-teal-700
">

03. Submit

</p>


<p class="
text-sm
text-slate-500
">

Pastikan nilai sudah benar.

</p>


</div>




</div>


</div>









{{-- FOOTER --}}


<div class="
mt-10
pb-10
flex
justify-between
text-sm
text-slate-500
">


<div>


<h3 class="
font-black
text-slate-800
">

BPPMHKP Lampung

</h3>


<p>
Organoleptic Assessment System
</p>


</div>




<div class="text-right">


<p>
Panelist Workspace
</p>


<p>
Version 1.0
</p>


</div>



</div>




</div>


</div>



</x-app-layout>