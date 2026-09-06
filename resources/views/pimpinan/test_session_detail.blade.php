<x-app-layout>


    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800">

            Detail Hasil Pengujian

        </h2>

    </x-slot>





    < class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">





            <!-- INFORMASI -->

            <div class="bg-white shadow rounded-lg p-6 mb-6">


                <h3 class="text-lg font-bold mb-4">

                    Informasi Pengujian

                </h3>



                <div class="grid grid-cols-2 gap-4">


                    <div>

                        <p class="text-gray-500">
                            Produk
                        </p>


                        <p class="font-bold">

                            {{ $testSession->sample->product->nama_produk }}

                        </p>

                    </div>




                    <div>

                        <p class="text-gray-500">
                            Nomor Sample
                        </p>


                        <p class="font-bold">

                            {{ $testSession->sample->nomor_sample }}

                        </p>


                    </div>





                    <div>

                        <p class="text-gray-500">
                            Tanggal Pengujian
                        </p>


                        <p class="font-bold">

                            {{ $testSession->tanggal_pengujian }}

                        </p>


                    </div>





                    <div>

                        <p class="text-gray-500">
                            Status
                        </p>



                        <p class="font-bold">

                            {{ ucfirst($testSession->status) }}

                        </p>


                    </div>



                </div>



            </div>










            <!-- HASIL PENILAIAN -->

            <div class="bg-white shadow rounded-lg p-6">


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


                            @php

                            $total = 0;

                            $kenampakan = 0;

                            $bau = 0;

                            $rasa = 0;

                            $tekstur = 0;

                            @endphp




                            @foreach($testSession->assessments as $index=>$assessment)


                            @php


                            $data=[];



                            foreach($assessment->details as $detail)

                            {


                            $data[$detail->criteria->nama_kriteria]
                            =
                            $detail->nilai;


                            }



                            $kenampakan += $data['Kenampakan'] ?? 0;

                            $bau += $data['Bau'] ?? 0;

                            $rasa += $data['Rasa'] ?? 0;

                            $tekstur += $data['Tekstur'] ?? 0;


                            $total += $assessment->total_nilai;


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




                                <td class="border px-4 py-2 text-center">

                                    {{ number_format($assessment->nilai_akhir,2) }}

                                </td>




                            </tr>



                            @endforeach





                        </tbody>


                    </table>



                </div>



            </div>










            <!-- NILAI AKHIR -->


            @php

            $nilaiMutu = 0;


            if($testSession->assessments->count()>0)

            {

            $nilaiMutu = $total /

            ($testSession->assessments->count()*4);

            }


            @endphp




            <div class="bg-white shadow rounded-lg mt-6 p-8 text-center">


                <h2 class="text-xl font-bold">

                    NILAI AKHIR MUTU (P)

                </h2>



                <div class="text-4xl font-bold text-blue-600 mt-4">


                    {{ number_format($nilaiMutu,2) }}


                </div>



                <p class="mt-2">

                    (DIBULATKAN 0.5)

                </p>


            </div>








            <div class="mt-8 flex gap-4">


                <a href="{{ route('pimpinan.test_sessions.pdf',$testSession->id) }}"

                    class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">


                    📄 Download PDF


                </a>





                <a href="{{ route('pimpinan.test_sessions.excel',$testSession->id) }}"

                    class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">


                    📊 Export Excel


                </a>





                <a href="{{ route('pimpinan.dashboard') }}"

                    class="px-5 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800">


                    ⬅ Kembali


                </a>



            </div>





        </div>





</x-app-layout>