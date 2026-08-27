<x-app-layout>


    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Sample
        </h2>

    </x-slot>





    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow-sm rounded-lg p-6">


                <form action="{{ route('admin.samples.store') }}"
                      method="POST">


                    @csrf



                    {{-- Produk --}}

                    <div class="mb-4">


                        <label class="block font-medium mb-2">

                            Produk

                        </label>



                        <select name="product_id"

                                class="w-full border rounded p-2">


                            <option value="">

                                -- Pilih Produk --

                            </option>



                            @foreach($products as $product)


                                <option value="{{ $product->id }}">

                                    {{ $product->nama_produk }}

                                </option>


                            @endforeach



                        </select>



                        @error('product_id')

                            <p class="text-red-600 text-sm mt-1">

                                {{ $message }}

                            </p>

                        @enderror



                    </div>





                    {{-- Nomor Sample --}}

                    <div class="mb-4">


                        <label class="block font-medium mb-2">

                            Nomor Sample

                        </label>



                        <input type="text"

                               name="nomor_sample"

                               class="w-full border rounded p-2"

                               placeholder="Contoh: S001">



                        @error('nomor_sample')

                            <p class="text-red-600 text-sm mt-1">

                                {{ $message }}

                            </p>

                        @enderror



                    </div>






                    {{-- Kode Sample --}}

                    <div class="mb-4">


                        <label class="block font-medium mb-2">

                            Kode Sample

                        </label>



                        <input type="text"

                               name="kode_sample"

                               class="w-full border rounded p-2"

                               placeholder="Contoh: CB-001">



                        @error('kode_sample')

                            <p class="text-red-600 text-sm mt-1">

                                {{ $message }}

                            </p>

                        @enderror



                    </div>






                    {{-- Tanggal --}}

                    <div class="mb-4">


                        <label class="block font-medium mb-2">

                            Tanggal

                        </label>



                        <input type="date"

                               name="tanggal"

                               class="w-full border rounded p-2">



                        @error('tanggal')

                            <p class="text-red-600 text-sm mt-1">

                                {{ $message }}

                            </p>

                        @enderror



                    </div>







                    <button type="submit"

                        class="bg-green-600 text-white px-4 py-2 rounded">

                        Simpan

                    </button>





                    <a href="{{ route('admin.samples.index') }}"

                       class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">

                        Kembali

                    </a>



                </form>


            </div>


        </div>


    </div>



</x-app-layout>