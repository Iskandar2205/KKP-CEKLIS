<x-app-layout>


<x-slot name="header">

<div>

<h2 class="text-2xl font-bold text-[#003B5C]">
Template Penilaian
</h2>

<p class="text-sm text-gray-500">
Import format penilaian organoleptik
</p>

</div>

</x-slot>




<div class="min-h-screen bg-[#F1F8FA] py-10">


<div class="max-w-5xl mx-auto px-6">


<div class="
bg-white
rounded-3xl
shadow-lg
p-8
">


@if(session('success'))

<div class="
bg-green-100
text-green-700
p-4
rounded-xl
mb-6
">

{{session('success')}}

</div>

@endif




<h1 class="
text-2xl
font-bold
text-[#003B5C]
">

Template Form Penilaian

</h1>


<p class="
text-gray-500
mt-2
mb-8
">

Upload template Excel untuk parameter organoleptik.

</p>





<div class="
grid
md:grid-cols-2
gap-6
">





<div class="
border
rounded-2xl
p-6
">


<h3 class="
font-bold
text-[#003B5C]
mb-3
">

Download Template

</h3>


<p class="
text-sm
text-gray-500
mb-5
">

Gunakan format Excel standar.

</p>



<a href="{{route('admin.templates.download')}}"

class="
inline-block
bg-[#0077B6]
text-white
px-5
py-3
rounded-xl
">

Download Excel

</a>


</div>







<div class="
border
rounded-2xl
p-6
">


<h3 class="
font-bold
text-[#003B5C]
mb-3
">

Upload Template

</h3>



<form

action="{{route('admin.templates.import')}}"

method="POST"

enctype="multipart/form-data">


@csrf



<input

type="file"

name="file"

class="
border
rounded-xl
p-3
w-full
mb-4
">


<button

class="
bg-[#F7941D]
text-white
px-5
py-3
rounded-xl
">

Upload Excel

</button>



</form>


</div>





</div>


</div>


</div>


</div>


</x-app-layout>