<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800">
            Master Produk
        </h2>

    </x-slot>



    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow-sm rounded-lg p-6">


                {{-- Header --}}
                <div class="flex justify-between items-center mb-6">


                    <h3 class="text-lg font-bold text-gray-800">
                        Daftar Produk
                    </h3>



                    <a href="{{ route('admin.products.create') }}"
                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                        + Tambah Produk

                    </a>


                </div>





                {{-- Notifikasi --}}
                @if(session('success'))

                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">

                        {{ session('success') }}

                    </div>

                @endif





                <table class="w-full border-collapse border">


                    <thead>

                        <tr class="bg-gray-100">


                            <th class="border p-3">
                                No
                            </th>


                            <th class="border p-3">
                                Nama Produk
                            </th>


                            <th class="border p-3">
                                Jenis Produk
                            </th>


                            <th class="border p-3">
                                Aksi
                            </th>


                        </tr>


                    </thead>





                    <tbody>


                    @forelse($products as $product)


                        <tr>


                            <td class="border p-3 text-center">

                                {{ $loop->iteration }}

                            </td>



                            <td class="border p-3">

                                {{ $product->nama_produk }}

                            </td>




                            <td class="border p-3">

                                {{ $product->jenis_produk }}

                            </td>





                            <td class="border p-3 text-center">


                                <a href="{{ route('admin.products.edit',$product->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                    Edit

                                </a>





                                <form action="{{ route('admin.products.destroy',$product->id) }}"
                                      method="POST"
                                      class="inline">


                                    @csrf

                                    @method('DELETE')



                                    <button type="submit"

                                    onclick="return confirm('Yakin ingin menghapus produk ini?')"

                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                        Hapus

                                    </button>


                                </form>



                            </td>


                        </tr>



                    @empty


                        <tr>

                            <td colspan="4"
                                class="border p-5 text-center text-gray-500">

                                Belum ada data produk

                            </td>

                        </tr>


                    @endforelse



                    </tbody>


                </table>



            </div>


        </div>


    </div>


</x-app-layout>