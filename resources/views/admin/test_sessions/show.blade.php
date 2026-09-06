<x-app-layout>


    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800">

            Detail Sesi Pengujian

        </h2>

    </x-slot>





    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow-sm rounded-lg p-6">





                <h3 class="text-xl font-bold mb-6">

                    {{ $testSession->sample->product->nama_produk }}

                </h3>








                {{-- Informasi Pengujian --}}


                <table class="w-full border-collapse border">



                    <tr>

                        <td class="border p-3 font-bold w-1/3">

                            Nomor Sample

                        </td>


                        <td class="border p-3">

                            {{ $testSession->sample->nomor_sample }}

                        </td>


                    </tr>








                    <tr>

                        <td class="border p-3 font-bold">

                            Tanggal Pengujian

                        </td>


                        <td class="border p-3">

                            {{ \Carbon\Carbon::parse($testSession->tanggal_pengujian)->format('d-m-Y') }}

                        </td>


                    </tr>








                    <tr>

                        <td class="border p-3 font-bold">

                            Status

                        </td>


                        <td class="border p-3">



                            @if($testSession->status == 'draft')


                            <span class="bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full">

                                Draft

                            </span>



                            @elseif($testSession->status == 'dibuka')


                            <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full">

                                Dibuka

                            </span>



                            @else


                            <span class="bg-gray-200 text-gray-800 px-3 py-1 rounded-full">

                                Selesai

                            </span>



                            @endif



                        </td>


                    </tr>








                    <tr>

                        <td class="border p-3 font-bold">

                            Catatan

                        </td>


                        <td class="border p-3">

                            {{ $testSession->catatan ?? '-' }}

                        </td>


                    </tr>



                </table>









                <hr class="my-8">







                {{-- Tim Pengujian --}}


                <h3 class="text-lg font-bold mb-4">

                    Tim Pengujian

                </h3>








                <table class="w-full border-collapse border">


                    <thead>


                        <tr class="bg-gray-100">


                            <th class="border p-3">

                                Nama

                            </th>


                            <th class="border p-3">

                                Peran

                            </th>


                        </tr>


                    </thead>







                    <tbody>



                        @forelse($testSession->sessionUsers as $user)



                        <tr>


                            <td class="border p-3">


                                @if($user->nama)


                                {{ $user->nama }}


                                @elseif($user->user)


                                {{ $user->user->name }}


                                @else


                                -


                                @endif



                            </td>



                            <td class="border p-3">


                                {{ ucfirst($user->role) }}


                            </td>



                        </tr>



                        @empty


                        <tr>


                            <td colspan="2" class="border p-3 text-center text-gray-500">


                                Belum ada anggota tim pengujian


                            </td>


                        </tr>



                        @endforelse





                    </tbody>


                </table>







                <a href="{{ route('admin.test_sessions.index') }}"

                    class="inline-block mt-6 bg-gray-500 text-white px-4 py-2 rounded">


                    Kembali


                </a>







            </div>


        </div>


    </div>


</x-app-layout>