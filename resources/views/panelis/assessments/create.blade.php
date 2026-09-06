<x-app-layout>


<div class="min-h-screen bg-[#F6FBFC] py-10">


<div class="max-w-5xl mx-auto px-6">



{{-- HEADER --}}

<div class="
relative
overflow-hidden
rounded-[35px]
bg-gradient-to-r
from-[#032B45]
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
w-72
h-72
rounded-full
bg-white/10
">
</div>



<div class="relative flex justify-between items-center">


<div>


<p class="
text-xs
tracking-[6px]
text-cyan-100
font-bold
">

BPPMHKP ORGANoleptic SYSTEM

</p>



<h1 class="
text-4xl
font-black
text-white
mt-4
">

Penilaian Sensori

</h1>



<p class="
mt-3
text-cyan-50
max-w-xl
">

Lakukan penilaian mutu sampel berdasarkan
parameter organoleptik yang tersedia.

</p>


</div>





<div class="
bg-white/20
backdrop-blur-xl
border
border-white/30
rounded-3xl
p-6
text-center
">


<p class="
text-xs
text-cyan-100
">

STATUS

</p>


<h3 class="
text-xl
font-black
text-white
mt-2
">

AKTIF

</h3>


</div>



</div>


</div>








<form

action="{{ route('panelis.assessment.store',$testSession->id) }}"

method="POST"

id="assessmentForm"

>


@csrf







{{-- PROGRESS --}}


@php

$totalCriteria = 0;

foreach($template->sections as $section){

$totalCriteria += $section->criterias->count();

}

@endphp





<div class="
bg-white
rounded-3xl
shadow-sm
border
border-slate-100
p-6
mb-8
">



<div class="flex justify-between items-center mb-4">



<div>


<h3 class="
font-black
text-slate-800
">

Progress Penilaian

</h3>


<p

id="progressText"

class="
text-sm
text-slate-500
mt-1
">

0 dari {{ $totalCriteria }} parameter selesai

</p>


</div>




<div

id="progressStatus"

class="
px-4
py-2
rounded-full
bg-blue-50
text-blue-700
font-bold
text-sm
">

0%

</div>



</div>






<div class="
w-full
h-3
bg-slate-100
rounded-full
overflow-hidden
">


<div

id="progressBar"

class="
h-3
rounded-full
bg-gradient-to-r
from-teal-500
to-cyan-500
transition-all
duration-500
"

style="width:0%"

>

</div>


</div>


</div>









{{-- PARAMETER --}}



@foreach($template->sections as $section)



<div class="mb-10">



<div class="
flex
items-center
gap-3
mb-6
">


<div class="
w-12
h-12
rounded-2xl
bg-teal-100
flex
items-center
justify-center
text-2xl
">

🧪

</div>



<h2 class="
text-2xl
font-black
text-slate-800
">

{{ $section->nama_section }}

</h2>



</div>

<h2 class="
text-2xl
font-black
text-slate-800
">

{{ $section->nama_section }}

</h2>



</div>

@foreach($section->criterias as $criteria)



<div class="
bg-white
rounded-[30px]
border
border-slate-100
shadow-sm
p-7
mb-6
">



<div class="
flex
justify-between
items-center
mb-6
">


<h3 class="
text-xl
font-black
text-slate-800
">

{{ $criteria->nama_kriteria }}

</h3>



<span class="
px-4
py-2
rounded-full
bg-cyan-50
text-cyan-700
text-xs
font-bold
">

Pilih Nilai

</span>


</div>






<div class="
space-y-4
">



@foreach($criteria->options as $option)



<label class="block cursor-pointer">


<input

type="radio"

name="nilai[{{ $criteria->id }}]"

value="{{ $option->nilai }}"

class="peer sr-only"

required

>




<div class="
flex
items-center
gap-6

rounded-3xl

border
border-slate-200

p-5

transition-all

duration-200

hover:border-teal-500

hover:bg-teal-50


peer-checked:border-teal-600

peer-checked:bg-teal-50

peer-checked:ring-2

peer-checked:ring-teal-200

">






<div class="
w-16
h-16
rounded-2xl
bg-slate-100

flex
items-center
justify-center

peer-checked:bg-teal-600

">


<span class="
text-3xl
font-black
text-teal-700
">

{{ $option->nilai }}

</span>


</div>








<div class="flex-1">


<p class="
text-slate-700
font-medium
leading-relaxed
">

{{ $option->deskripsi }}

</p>


</div>



</div>


</label>



@endforeach



</div>



</div>



@endforeach



</div>



@endforeach







{{-- BUTTON SIMPAN --}}



<div class="
flex
justify-end
pb-10
">


<button

type="submit"

class="
px-10
py-4

rounded-2xl

bg-gradient-to-r

from-teal-600

to-cyan-500

text-white

font-black

shadow-lg

hover:-translate-y-1

transition

">


✓ Simpan Penilaian


</button>


</div>





</form>


</div>

</div>









<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>


// ===============================
// PROGRESS PENILAIAN REALTIME
// ===============================


const totalParameter = Number("{{ $totalCriteria }}");



function updateProgress(){


let selesai = document
.querySelectorAll(
'input[type="radio"]:checked'
)
.length;



let persen = 0;


if(totalParameter > 0){

persen = Math.round(
(selesai / totalParameter) * 100
);

}



document
.getElementById('progressBar')
.style.width = persen + "%";




document
.getElementById('progressText')
.innerHTML =

selesai +
" dari " +
totalParameter +
" parameter selesai";





let badge =
document.getElementById('progressStatus');





if(persen === 100){


badge.className = `

px-4
py-2
rounded-full
bg-green-100
text-green-700
font-bold
text-sm

`;


badge.innerHTML =
"✓ Siap Submit";



}else{


badge.className = `

px-4
py-2
rounded-full
bg-blue-50
text-blue-700
font-bold
text-sm

`;


badge.innerHTML =
persen+"%";


}



}





document
.querySelectorAll(
'input[type="radio"]'
)
.forEach(function(input){


input.addEventListener(
'change',
updateProgress
);


});



updateProgress();








// ===============================
// KONFIRMASI SIMPAN
// ===============================


document
.getElementById('assessmentForm')
.addEventListener('submit', function(e){


e.preventDefault();




Swal.fire({


title:
'Konfirmasi Penilaian',



html:`

<div style="text-align:left">


<p>
Anda akan menyimpan hasil penilaian organoleptik.
</p>



<div style="
margin-top:15px;
padding:15px;
background:#F0FDFA;
border-radius:12px;
">


<b>Pastikan:</b>


<ul>


<li>
Semua parameter sudah diberikan nilai.
</li>


<li>
Data akan menjadi hasil pengujian.
</li>


<li>
Periksa kembali sebelum menyimpan.
</li>


</ul>


</div>


</div>

`,



icon:
'warning',



showCancelButton:
true,



confirmButtonText:
'✓ Ya, Simpan',



cancelButtonText:
'Periksa Lagi',



confirmButtonColor:
'#0F766E',



cancelButtonColor:
'#64748B',



reverseButtons:
true



})


.then((result)=>{


if(result.isConfirmed){


Swal.fire({

title:
'Menyimpan Data',

text:
'Mohon tunggu...',

icon:
'info',

showConfirmButton:false,

allowOutsideClick:false

});



this.submit();



}



});



});



</script>



</x-app-layout>