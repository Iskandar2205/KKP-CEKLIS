<x-app-layout>


<x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800">
        Buat Sesi Pengujian
    </h2>

</x-slot>





<div class="py-12">


<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


<div class="bg-white shadow-sm rounded-lg p-6">



<form action="{{ route('admin.test_sessions.store') }}"
      method="POST">

@csrf







{{-- SAMPLE --}}

<div class="mb-4">

<label class="block font-medium mb-2">
    Sample Pengujian
</label>


<select name="sample_id"
        class="w-full border rounded p-2">


<option value="">
    -- Pilih Sample --
</option>


@foreach($samples as $sample)

<option value="{{ $sample->id }}">

{{ $sample->product->nama_produk }}
-
{{ $sample->nomor_sample }}

</option>

@endforeach


</select>

</div>








{{-- TANGGAL --}}

<div class="mb-4">

<label class="block font-medium mb-2">
    Tanggal Pengujian
</label>


<input type="date"
       name="tanggal_pengujian"
       class="w-full border rounded p-2">

</div>








{{-- STATUS --}}

<div class="mb-4">

<label class="block font-medium mb-2">
    Status
</label>


<select name="status"
        class="w-full border rounded p-2">


<option value="draft">
    Draft
</option>


<option value="dibuka">
    Dibuka
</option>


<option value="selesai">
    Selesai
</option>


</select>

</div>








{{-- CATATAN --}}

<div class="mb-4">

<label class="block font-medium mb-2">
    Catatan
</label>


<textarea name="catatan"
          rows="4"
          class="w-full border rounded p-2"
          placeholder="Catatan pengujian..."></textarea>

</div>









{{-- PANELIS --}}

<div class="mb-6">


<label class="block font-medium mb-3">
    Panelis
</label>



<div id="panelis-wrapper" class="space-y-4">






{{-- PANELIS 1 --}}

<div class="panelis-row flex items-center gap-4">


<label class="w-32 font-medium">
    Panelis 1
</label>


<select name="panelis[]"
        class="flex-1 border rounded p-2">


<option value="">
    -- Pilih Panelis --
</option>


@foreach($panelis as $user)

<option value="{{ $user->id }}">
    {{ $user->name }}
</option>

@endforeach


</select>



<button type="button"
        onclick="hapusPanelis(this)"
        class="bg-red-600 text-white px-3 py-2 rounded">

Hapus

</button>


</div>








{{-- PANELIS 2 --}}

<div class="panelis-row flex items-center gap-4">


<label class="w-32 font-medium">
    Panelis 2
</label>


<select name="panelis[]"
        class="flex-1 border rounded p-2">


<option value="">
    -- Pilih Panelis --
</option>


@foreach($panelis as $user)

<option value="{{ $user->id }}">
    {{ $user->name }}
</option>

@endforeach


</select>



<button type="button"
        onclick="hapusPanelis(this)"
        class="bg-red-600 text-white px-3 py-2 rounded">

Hapus

</button>


</div>








{{-- PANELIS 3 --}}

<div class="panelis-row flex items-center gap-4">


<label class="w-32 font-medium">
    Panelis 3
</label>


<select name="panelis[]"
        class="flex-1 border rounded p-2">


<option value="">
    -- Pilih Panelis --
</option>


@foreach($panelis as $user)

<option value="{{ $user->id }}">
    {{ $user->name }}
</option>

@endforeach


</select>



<button type="button"
        onclick="hapusPanelis(this)"
        class="bg-red-600 text-white px-3 py-2 rounded">

Hapus

</button>


</div>



</div>







<button type="button"
        onclick="tambahPanelis()"
        class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">

+ Tambah Panelis

</button>



</div>









{{-- PENYELIA --}}

<div class="mb-6">


<label class="block font-medium mb-2">
    Penyelia
</label>



<select name="penyelia"
        class="w-full border rounded p-2">



<option value="5">

Pak Wirsan

</option>



</select>


</div>








<button type="submit"

class="bg-green-600 text-white px-4 py-2 rounded">


Simpan Sesi


</button>






<a href="{{ route('admin.test_sessions.index') }}"

class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">


Kembali


</a>





</form>



</div>


</div>


</div>








<script>


let jumlahPanelis = 3;



function tambahPanelis()

{


jumlahPanelis++;


let wrapper = document.getElementById('panelis-wrapper');


let div = document.createElement('div');


div.className =
"panelis-row flex items-center gap-4";



div.innerHTML = `


<label class="w-32 font-medium">

Panelis ${jumlahPanelis}

</label>



<select name="panelis[]"

class="flex-1 border rounded p-2">


<option value="">
-- Pilih Panelis --
</option>



@foreach($panelis as $user)

<option value="{{ $user->id }}">

{{ $user->name }}

</option>

@endforeach



</select>





<button type="button"

onclick="hapusPanelis(this)"

class="bg-red-600 text-white px-3 py-2 rounded">

Hapus

</button>


`;



wrapper.appendChild(div);


}







function hapusPanelis(button)

{


let row = button.closest('.panelis-row');


row.remove();


}



</script>





</x-app-layout>