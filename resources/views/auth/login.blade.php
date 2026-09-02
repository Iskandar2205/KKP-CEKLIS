<x-guest-layout>


<div class="min-h-screen flex items-center justify-center 
relative overflow-hidden bg-cover bg-center"
style="
background-image:
linear-gradient(
rgba(2,27,51,0.75),
rgba(0,70,90,0.65)
),
url('{{ asset('images/kapallaut.png') }}');
">



{{-- BACKGROUND EFFECT --}}

<div class="
absolute 
w-96 h-96 
bg-blue-300 
opacity-20 
rounded-full 
blur-3xl 
-top-32 
-left-32">
</div>



<div class="
absolute 
w-64 h-64 
bg-orange-400 
opacity-40 
rounded-full 
blur-3xl 
top-10 
right-10">
</div>



<div class="
absolute 
w-80 h-80 
bg-teal-300 
opacity-20 
rounded-full 
blur-3xl 
bottom-0 
right-0">
</div>






<div class="
relative 
z-10
w-full
max-w-7xl
mx-auto
px-10
grid
md:grid-cols-2
gap-10
items-center
">







{{-- LEFT SIDE --}}

<div class="text-white">



<img src="{{ asset('images/logo-bppmhkp.png') }}"
class="w-44 mb-8">





<h1 class="
text-5xl
font-bold
leading-tight
mb-6
">

Sistem Uji
<br>
Organoleptik

</h1>





<p class="
text-lg
text-gray-200
max-w-xl
mb-8
">

Digitalisasi pengujian mutu hasil kelautan
dan perikanan BPPMHKP

</p>







<div class="space-y-4">



<div class="
flex 
items-center
gap-4
">


<div class="
w-12
h-12
rounded-xl
bg-white/20
flex
items-center
justify-center
">

🧪

</div>


<div>

<h3 class="font-semibold">

Pengujian Mutu Produk

</h3>

<p class="text-sm text-gray-300">

Terstandar dan objektif

</p>


</div>


</div>








<div class="
flex 
items-center
gap-4
">


<div class="
w-12
h-12
rounded-xl
bg-white/20
flex
items-center
justify-center
">

🌊

</div>


<div>

<h3 class="font-semibold">

Standar Kelautan dan Perikanan

</h3>

<p class="text-sm text-gray-300">

Mendukung keamanan pangan

</p>


</div>


</div>









<div class="
flex 
items-center
gap-4
">


<div class="
w-12
h-12
rounded-xl
bg-white/20
flex
items-center
justify-center
">

✓

</div>


<div>

<h3 class="font-semibold">

Sistem Penilaian Organoleptik

</h3>

<p class="text-sm text-gray-300">

Efisien, akurat, dan terdokumentasi

</p>


</div>


</div>





</div>





</div>









{{-- LOGIN CARD --}}


<div class="flex justify-center">



<div class="
bg-white/95
backdrop-blur-xl
rounded-3xl
shadow-2xl
w-full
max-w-md
p-10
">






<h2 class="
text-3xl
font-bold
text-gray-900
text-center
mb-2
">

Selamat Datang

</h2>




<p class="
text-center
text-gray-500
mb-8
">

Masuk ke Sistem Uji Organoleptik

</p>







<form method="POST" action="{{ route('login') }}">

@csrf





{{-- Username --}}

<div class="mb-5">

<label class="
block
font-medium
text-gray-700
mb-2
">

Username

</label>



<input 
type="text"
name="username"
class="
w-full
rounded-xl
border-gray-300
focus:border-blue-500
focus:ring-blue-500
"
placeholder="Masukkan username"
required>


</div>








{{-- Password --}}

<div class="mb-5">

<label class="
block
font-medium
text-gray-700
mb-2
">

Password

</label>



<input 
type="password"
name="password"
class="
w-full
rounded-xl
border-gray-300
focus:border-blue-500
focus:ring-blue-500
"
placeholder="Masukkan password"
required>


</div>







<div class="
flex
items-center
mb-6
">


<input 
type="checkbox"
name="remember"
class="rounded">


<label class="
ml-2
text-gray-600
text-sm
">

Ingat saya

</label>


</div>









<button
type="submit"
class="
w-full
bg-orange-500
hover:bg-orange-600
text-white
font-bold
py-3
rounded-xl
shadow-lg
transition
">

MASUK SISTEM

</button>









<div class="
text-center
mt-8
text-sm
text-gray-400
">


© {{ date('Y') }} BPPMHKP

<br>

Sistem Pengujian Mutu Hasil Kelautan dan Perikanan


</div>





</form>



</div>


</div>






</div>



</div>



</x-guest-layout>