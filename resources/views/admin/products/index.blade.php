<x-app-layout>


<x-slot name="header">

<div>

<h2 class="text-2xl font-bold text-[#003B5C]">
Product Database
</h2>

<p class="text-sm text-gray-500">
Master data produk pengujian organoleptik BPPMHKP
</p>

</div>

</x-slot>





<div class="min-h-screen bg-[#F2FAFC] py-10">


<div class="max-w-7xl mx-auto px-6">







{{-- HEADER PANEL --}}


<div class="
bg-gradient-to-r
from-[#003B5C]
to-[#0077B6]
rounded-3xl
p-8
text-white
shadow-lg
mb-8
relative
overflow-hidden
">



<div class="relative z-10">


<p class="
text-xs
uppercase
tracking-[0.3em]
text-blue-200
">

MASTER DATA

</p>



<h1 class="
text-4xl
font-bold
mt-3
">

Produk Kelautan

</h1>



<p class="
mt-3
text-blue-100
max-w-xl
">

Kelola daftar produk hasil kelautan
yang digunakan dalam proses pengujian mutu.

</p>



</div>





<div class="
absolute
right-10
bottom-5
opacity-20
">

<svg width="180" height="100">

<path 
d="M0 60 Q50 20 100 60 T200 60"
stroke="white"
stroke-width="4"
fill="none"/>

</svg>


</div>



</div>









{{-- SUMMARY --}}


<div class="
grid
grid-cols-1
md:grid-cols-3
gap-6
mb-8
">





<div class="
bg-white
rounded-3xl
p-6
shadow-sm
">


<p class="
text-sm
text-gray-400
uppercase
">

Total Produk

</p>


<h1 class="
text-5xl
font-bold
text-[#003B5C]
mt-3
">

{{ $products->count() }}

</h1>


<p class="
text-sm
text-gray-500
mt-2
">

Produk terdaftar

</p>


</div>




<div class="
bg-white
rounded-3xl
p-6
shadow-sm
">


<p class="
text-sm
text-gray-400
uppercase
">

Kategori

</p>


<h1 class="
text-5xl
font-bold
text-[#003B5C]
mt-3
">

{{ $products->unique('jenis_produk')->count() }}

</h1>


<p class="
text-sm
text-gray-500
mt-2
">

Jenis produk

</p>


</div>



<div class="
bg-[#003B5C]
rounded-3xl
p-6
text-white
">


<p class="
text-sm
text-blue-200
uppercase
">

Action

</p>


<a href="{{route('admin.products.create')}}"
class="
inline-block
mt-5
bg-[#F7941D]
px-6
py-3
rounded-xl
font-semibold
hover:bg-orange-500
transition
">

+ Tambah Produk

</a>


</div>






</div>









{{-- TABLE --}}


<div class="
bg-white
rounded-3xl
shadow-sm
p-8
">



<div class="
flex
justify-between
items-center
mb-6
">


<h2 class="
text-xl
font-bold
text-[#003B5C]
">

Daftar Produk

</h2>


<span class="
text-xs
text-gray-400
">

Product Repository

</span>


</div>








<div class="overflow-x-auto">


<table class="
w-full
border-collapse
">



<thead>


<tr class="
bg-[#003B5C]
text-white
text-sm
">


<th class="
px-5
py-4
text-left
rounded-l-xl
">

No

</th>


<th class="
px-5
py-4
text-left
">

Nama Produk

</th>


<th class="
px-5
py-4
text-left
">

Jenis Produk

</th>


<th class="
px-5
py-4
text-center
rounded-r-xl
">

Aksi

</th>


</tr>


</thead>






<tbody>



@forelse($products as $index=>$product)



<tr class="
border-b
hover:bg-[#F2FAFC]
transition
">



<td class="
px-5
py-4
text-gray-600
">

{{ $index+1 }}

</td>




<td class="
px-5
py-4
font-semibold
text-[#003B5C]
">


{{ $product->nama_produk }}


</td>





<td class="
px-5
py-4
">


<span class="
bg-[#E7F7FA]
text-[#0077B6]
px-4
py-2
rounded-full
text-sm
">

{{ $product->jenis_produk }}

</span>


</td>


<td class="
px-5
py-4
text-center
">


<div class="flex justify-center gap-2">



<a href="{{ route('admin.products.dataset', $product->id) }}"

class="
bg-[#0077B6]
text-white
px-3
py-2
rounded-lg
text-sm
hover:bg-[#005B8A]
transition
"
class="btn btn-primary">
>



Dataset

</a>


<a href="{{ route('admin.products.edit',$product->id) }}"

class="
bg-[#00A896]
text-white
px-3
py-2
rounded-lg
text-sm
hover:bg-green-600
transition
">

Edit

</a>





<form action="{{route('admin.products.destroy',$product)}}"

method="POST">


@csrf

@method('DELETE')


<button

onclick="return confirm('Hapus produk ini?')"

class="
bg-red-500
text-white
px-3
py-2
rounded-lg
text-sm
hover:bg-red-600
transition
">

Hapus

</button>


</form>



</div>


</td>



</tr>




@empty


<tr>

<td colspan="4"
class="
text-center
py-10
text-gray-400
">

Belum ada data produk

</td>

</tr>


@endforelse





</tbody>



</table>


</div>




</div>







</div>

</div>


</x-app-layout>