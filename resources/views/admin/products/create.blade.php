<x-app-layout>


    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Produk
        </h2>

    </x-slot>




    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow-sm rounded-lg p-6">


                <form action="{{ route('admin.products.store') }}"
                      method="POST">


                    @csrf



                    <!-- Nama Produk -->

                    <div class="mb-4">

                        <label class="block font-medium">
                            Nama Produk
                        </label>


                        <input type="text"
                               name="nama_produk"
                               class="w-full border rounded p-2"
                               placeholder="Contoh: Cumi Beku">


                    </div>




                    <!-- Jenis Produk -->

                    <div class="mb-4">

                        <label class="block font-medium">
                            Jenis Produk
                        </label>


                        <input type="text"
                               name="jenis_produk"
                               class="w-full border rounded p-2"
                               placeholder="Contoh: Frozen Seafood">


                    </div>





                    <button type="submit"

                    class="bg-green-600 text-white px-4 py-2 rounded">

                        Simpan

                    </button>



                    <a href="{{ route('admin.products.index') }}"

                    class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">

                        Kembali

                    </a>



                </form>


            </div>


        </div>


    </div>


</x-app-layout>