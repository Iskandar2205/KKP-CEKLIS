<x-app-layout>


    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800">
            Master Sample
        </h2>

    </x-slot>





    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow-sm rounded-lg p-6">



                {{-- Header --}}

                <div class="flex justify-between items-center mb-6">


                    <h3 class="text-lg font-bold text-gray-800">

                        Daftar Sample

                    </h3>




                    <a href="{{ route('admin.samples.create') }}"

                       class="bg-blue-600 text-white px-4 py-2 rounded-lg">

                        + Tambah Sample

                    </a>


                </div>





                {{-- Alert --}}

                @if(session('success'))

                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">

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
                                Produk
                            </th>


                            <th class="border p-3">
                                Nomor Sample
                            </th>


                            <th class="border p-3">
                                Kode Sample
                            </th>


                            <th class="border p-3">
                                Tanggal
                            </th>


                            <th class="border p-3">
                                Aksi
                            </th>


                        </tr>


                    </thead>





                    <tbody>


                    @forelse($samples as $sample)


                        <tr>


                            <td class="border p-3 text-center">

                                {{ $loop->iteration }}

                            </td>




                            <td class="border p-3">

                                {{ $sample->product->nama_produk }}

                            </td>




                            <td class="border p-3">

                                {{ $sample->nomor_sample }}

                            </td>




                            <td class="border p-3">

                                {{ $sample->kode_sample }}

                            </td>




                            <td class="border p-3">

                                {{ $sample->tanggal }}

                            </td>




                            <td class="border p-3 text-center">


                                <a href="{{ route('admin.samples.edit',$sample->id) }}"

                                   class="bg-yellow-500 text-white px-3 py-1 rounded">

                                    Edit

                                </a>





                                <form action="{{ route('admin.samples.destroy',$sample->id) }}"

                                      method="POST"

                                      class="inline">


                                    @csrf

                                    @method('DELETE')



                                    <button type="submit"

                                    onclick="return confirm('Hapus sample ini?')"

                                    class="bg-red-600 text-white px-3 py-1 rounded">

                                        Hapus

                                    </button>



                                </form>


                            </td>


                        </tr>



                    @empty


                        <tr>


                            <td colspan="6"

                                class="border p-5 text-center">

                                Belum ada sample


                            </td>


                        </tr>


                    @endforelse



                    </tbody>


                </table>



            </div>


        </div>


    </div>



</x-app-layout>