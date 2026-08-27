<x-app-layout>


    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800">

            Edit Sample

        </h2>

    </x-slot>





    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow-sm rounded-lg p-6">



                <form action="{{ route('admin.samples.update',$sample->id) }}"
                      method="POST">


                    @csrf

                    @method('PUT')





                    {{-- Produk --}}

                    <div class="mb-4">


                        <label class="block font-medium mb-2">

                            Produk

                        </label>



                        <select name="product_id"

                                class="w-full border rounded p-2">


                            @foreach($products as $product)


                                <option value="{{ $product->id }}"

                                {{ $sample->product_id == $product->id ? 'selected' : '' }}>


                                    {{ $product->nama_produk }}


                                </option>


                            @endforeach



                        </select>


                    </div>






                    {{-- Nomor Sample --}}

                    <div class="mb-4">


                        <label class="block font-medium mb-2">

                            Nomor Sample

                        </label>



                        <input type="text"

                               name="nomor_sample"

                               value="{{ $sample->nomor_sample }}"

                               class="w-full border rounded p-2">


                    </div>







                    {{-- Kode Sample --}}

                    <div class="mb-4">


                        <label class="block font-medium mb-2">

                            Kode Sample

                        </label>



                        <input type="text"

                               name="kode_sample"

                               value="{{ $sample->kode_sample }}"

                               class="w-full border rounded p-2">


                    </div>






                    {{-- Tanggal --}}

                    <div class="mb-4">


                        <label class="block font-medium mb-2">

                            Tanggal

                        </label>



                        <input type="date"

                               name="tanggal"

                               value="{{ $sample->tanggal }}"

                               class="w-full border rounded p-2">


                    </div>







                    <button type="submit"

                    class="bg-blue-600 text-white px-4 py-2 rounded">

                        Update

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