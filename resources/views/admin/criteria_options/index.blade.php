<x-app-layout>


    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800">

            Skala Penilaian

        </h2>

    </x-slot>





    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow-sm rounded-lg p-6">



                <div class="flex justify-between mb-5">


                    <h3 class="text-lg font-bold">

                        Daftar Skala Penilaian

                    </h3>



                    <a href="{{ route('admin.criteria_options.create') }}"

                       class="bg-blue-600 text-white px-4 py-2 rounded">

                        + Tambah Skala

                    </a>


                </div>





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

                                Nilai

                            </th>


                            <th class="border p-3">

                                Deskripsi

                            </th>


                            <th class="border p-3">

                                Aksi

                            </th>


                        </tr>


                    </thead>





                    <tbody>


                    @forelse($criteriaOptions as $item)


                        <tr>


                            <td class="border p-3 text-center">

                                {{ $loop->iteration }}

                            </td>


                            <td class="border p-3 text-center">

                                {{ $item->nilai }}

                            </td>


                            <td class="border p-3">

                                {{ $item->deskripsi }}

                            </td>


                            <td class="border p-3 text-center">


                                <form action="{{ route('admin.criteria_options.destroy',$item->id) }}"

                                      method="POST">


                                    @csrf

                                    @method('DELETE')



                                    <button

                                    onclick="return confirm('Hapus skala ini?')"

                                    class="bg-red-600 text-white px-3 py-1 rounded">


                                        Hapus


                                    </button>


                                </form>


                            </td>


                        </tr>


                    @empty


                        <tr>


                            <td colspan="4"

                                class="border p-4 text-center">


                                Belum ada data


                            </td>


                        </tr>


                    @endforelse



                    </tbody>



                </table>



            </div>


        </div>


    </div>


</x-app-layout>