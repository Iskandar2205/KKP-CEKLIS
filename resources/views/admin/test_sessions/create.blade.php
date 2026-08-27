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






                    {{-- Sample --}}

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









                    {{-- Tanggal --}}

                    <div class="mb-4">


                        <label class="block font-medium mb-2">
                            Tanggal Pengujian
                        </label>


                        <input type="date"
                               name="tanggal_pengujian"
                               class="w-full border rounded p-2">


                    </div>









                    {{-- Status --}}

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









                    {{-- Catatan --}}

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
        Pilih Panelis
    </label>


    <select 
        name="panelis[]"
        multiple
        class="w-full border rounded p-2">


        @foreach($panelis as $user)


            <option value="{{ $user->id }}">

                {{ $user->name }}

            </option>


        @endforeach


    </select>


    <p class="text-sm text-gray-500 mt-2">
        Tekan CTRL untuk memilih lebih dari satu panelis
    </p>


</div>








                    {{-- Penyelia --}}

                    <div class="mb-6">


                        <label class="block font-medium mb-2">

                            Pilih Penyelia

                        </label>



                        <select name="penyelia"

                                class="w-full border rounded p-2">


                            <option value="">
                                -- Pilih Penyelia --
                            </option>



                            @foreach($penyelia as $user)


                                <option value="{{ $user->id }}">

                                    {{ $user->name }}

                                </option>


                            @endforeach



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


let jumlahPanelis = 1;



function tambahPanelis()

{


    jumlahPanelis++;



    let wrapper = document.getElementById('panelis-wrapper');



    let div = document.createElement('div');



    div.className = "flex gap-3 items-center mb-3 panelis-row";



    div.innerHTML = `


        <div class="flex-1">


            <label class="block text-sm font-medium mb-1">

                Panelis ${jumlahPanelis}

            </label>



            <input type="text"

                   name="panelis[]"

                   placeholder="Nama Panelis"

                   class="w-full border rounded p-2">


        </div>



<button type="button"

        onclick="hapusPanelis(this)"

        class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-2 rounded h-10">

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