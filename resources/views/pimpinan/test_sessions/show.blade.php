<x-app-layout>


    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            Detail Pengujian

        </h2>

    </x-slot>





    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">





            <!-- INFORMASI -->

            <div class="bg-white shadow rounded-lg p-6 mb-6">


                <h3 class="text-xl font-bold mb-4">

                    Informasi Pengujian

                </h3>



                <div class="grid grid-cols-2 gap-4">


                    <div>

                        <b>Produk</b>

                        <p>
                            {{ $testSession->sample->product->nama_produk }}
                        </p>

                    </div>



                    <div>

                        <b>Nomor Sample</b>

                        <p>
                            {{ $testSession->sample->nomor_sample }}
                        </p>

                    </div>



                    <div>

                        <b>Tanggal Pengujian</b>

                        <p>
                            {{ $testSession->tanggal_pengujian }}
                        </p>

                    </div>




                    <div>

                        <b>Status</b>

                        <p>


                            @if($testSession->status == 'selesai')

                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded">
                                Selesai
                            </span>


                            @elseif($testSession->status == 'dibuka')

                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded">
                                Berjalan
                            </span>


                            @else

                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded">
                                Draft
                            </span>


                            @endif


                        </p>

                    </div>


                </div>


            </div>









            <!-- HASIL PANELIS -->


            <div class="bg-white shadow rounded-lg p-6 mb-6">


                <h3 class="text-lg font-bold mb-5">

                    Hasil Penilaian Panelis

                </h3>




                <div class="overflow-x-auto">


                    <table class="min-w-full border">


                        <thead class="bg-gray-100">

                            <tr>

                                <th class="border px-4 py-2">
                                    No
                                </th>


                                <th class="border px-4 py-2">
                                    Panelis
                                </th>


                                <th class="border px-4 py-2">
                                    Kenampakan
                                </th>


                                <th class="border px-4 py-2">
                                    Bau
                                </th>


                                <th class="border px-4 py-2">
                                    Rasa
                                </th>


                                <th class="border px-4 py-2">
                                    Tekstur
                                </th>


                                <th class="border px-4 py-2">
                                    Jumlah
                                </th>


                                <th class="border px-4 py-2">
                                    Rata-rata
                                </th>


                            </tr>

                        </thead>




                        <tbody>


                            @foreach($testSession->assessments as $index=>$assessment)


                            @php

                            $data=[];

                            foreach($assessment->details as $detail){

                            $data[$detail->criteria->nama_kriteria]
                            =
                            $detail->nilai;

                            }

                            @endphp



                            <tr>


                                <td class="border px-4 py-2 text-center">

                                    {{ $index+1 }}

                                </td>



                                <td class="border px-4 py-2">

                                    {{ $assessment->user->name }}

                                </td>



                                <td class="border px-4 py-2 text-center">

                                    {{ $data['Kenampakan'] ?? '-' }}

                                </td>



                                <td class="border px-4 py-2 text-center">

                                    {{ $data['Bau'] ?? '-' }}

                                </td>



                                <td class="border px-4 py-2 text-center">

                                    {{ $data['Rasa'] ?? '-' }}

                                </td>



                                <td class="border px-4 py-2 text-center">

                                    {{ $data['Tekstur'] ?? '-' }}

                                </td>



                                <td class="border px-4 py-2 text-center">

                                    {{ $assessment->total_nilai }}

                                </td>



                                <td class="border px-4 py-2 text-center font-bold">

                                    {{ number_format($assessment->nilai_akhir,2) }}

                                </td>


                            </tr>



                            @endforeach


                        </tbody>


                    </table>


                </div>


            </div>









            <!-- NILAI AKHIR -->


            <div class="bg-white shadow rounded-lg p-6 text-center">


                <h3 class="text-xl font-bold">

                    Nilai Akhir Mutu (P)

                </h3>



                <p class="text-4xl font-bold text-blue-600 mt-4">

                    {{ number_format($nilaiMutu,2) }}

                </p>



                <p class="mt-2">

                    (Dibulatkan 0.5)

                </p>


            </div>








            <!-- BUTTON -->


            <div class="flex justify-center gap-4 mt-8">



                <a href="{{ route('pimpinan.dashboard') }}"

                    class="px-5 py-2 bg-gray-500 text-white rounded">

                    ← Kembali

                </a>





                <a href="{{ route('pimpinan.test_sessions.pdf',$testSession->id) }}"

                    class="px-5 py-2 bg-red-600 text-white rounded">

                    📄 Download PDF

                </a>





                <a href="{{ route('pimpinan.test_sessions.excel',$testSession->id) }}"

                    class="px-5 py-2 bg-green-600 text-white rounded">

                    📊 Download Excel

                </a>




            </div>





        </div>

    </div>



</x-app-layout>