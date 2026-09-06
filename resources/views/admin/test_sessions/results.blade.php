<x-app-layout>


    <x-slot name="header">

        <h2 class="font-bold text-xl text-[#003B5C]">
            Hasil Penilaian Organoleptik
        </h2>

    </x-slot>



    <div class="py-10">


        <div class="max-w-7xl mx-auto px-6">



            <div class="bg-white rounded-2xl shadow p-8">



                {{-- INFORMASI --}}

                <div class="flex justify-between mb-8">


                    <div>

                        <h1 class="text-2xl font-bold">

                            {{ $testSession->sample->product->nama_produk }}

                        </h1>


                        <p class="mt-3">
                            Nomor Sample :
                            {{ $testSession->sample->nomor_sample }}
                        </p>


                        <p>
                            Tanggal :
                            {{ $testSession->tanggal_pengujian }}
                        </p>


                    </div>




                    <div class="text-right">


                        <p class="font-semibold">

                            Jenis Produk :

                            {{ $testSession->sample->product->nama_produk }}

                        </p>


                    </div>


                </div>







                {{-- TABEL NILAI --}}


                <div class="overflow-x-auto">


                    <table class="w-full border-collapse border">


                        <thead>


                            <tr class="bg-gray-100">


                                <th class="border p-3">
                                    No
                                </th>


                                <th class="border p-3">
                                    Panelis
                                </th>


                                @foreach($criteriaList as $criteria)

                                <th class="border p-3">
                                    {{ $criteria->nama_kriteria }}
                                </th>

                                @endforeach



                                <th class="border p-3">
                                    Jumlah
                                </th>


                                <th class="border p-3">
                                    Rata-rata
                                </th>


                            </tr>


                        </thead>




                        <tbody>



                            @foreach($testSession->assessments as $index=>$assessment)


                            @php

                            $data=[];

                            foreach($assessment->details as $detail)
                            {

                            $data[$detail->criteria->nama_kriteria]
                            =
                            $detail->nilai;

                            }

                            @endphp



                            <tr>


                                <td class="border p-3 text-center">

                                    {{ $index+1 }}

                                </td>



                                <td class="border p-3">

                                    {{ $assessment->user->name }}

                                </td>




                                @foreach($criteriaList as $criteria)


                                <td class="border p-3 text-center">

                                    {{ $data[$criteria->nama_kriteria] ?? '-' }}

                                </td>


                                @endforeach




                                <td class="border p-3 text-center">

                                    {{ $assessment->total_nilai }}

                                </td>



                                <td class="border p-3 text-center">

                                    {{ number_format($assessment->nilai_akhir,2) }}

                                </td>


                            </tr>


                            @endforeach





                            {{-- JUMLAH --}}

                            <tr class="font-bold bg-gray-50">


                                <td colspan="2"
                                    class="border p-3 text-center">

                                    Jumlah

                                </td>




                                @foreach($criteriaList as $criteria)


                                <td class="border p-3 text-center">


                                    {{
$testSession
->assessments
->flatMap->details
->where('criteria_id',$criteria->id)
->sum('nilai')
}}


                                </td>


                                @endforeach





                                <td class="border p-3 text-center">

                                    {{ $testSession->assessments->sum('total_nilai') }}

                                </td>




                                <td class="border p-3 text-center">

                                    {{ number_format($rataRata,2) }}

                                </td>


                            </tr>



                        </tbody>


                    </table>


                </div>







                {{-- STATISTIK --}}


                <div class="grid grid-cols-2 gap-8 mt-8">



                    <div>


                        <table class="w-full border">


                            <tr>

                                <td class="border p-3">
                                    Konstanta
                                </td>

                                <td class="border p-3">
                                    1.96
                                </td>

                            </tr>



                            <tr>

                                <td class="border p-3">
                                    n (Jumlah Panelis)
                                </td>

                                <td class="border p-3">

                                    {{ $jumlahPanelis }}

                                </td>

                            </tr>



                            <tr>

                                <td class="border p-3">
                                    √n
                                </td>

                                <td class="border p-3">

                                    {{ number_format(sqrt($jumlahPanelis),8) }}

                                </td>

                            </tr>



                            <tr>

                                <td class="border p-3">
                                    P min
                                </td>

                                <td class="border p-3">

                                    -

                                </td>

                            </tr>



                            <tr>

                                <td class="border p-3">
                                    P max
                                </td>

                                <td class="border p-3">

                                    -

                                </td>

                            </tr>



                            <tr class="font-bold">

                                <td class="border p-3">
                                    P (Skor Akhir Mutu)
                                </td>

                                <td class="border p-3">

                                    {{ number_format($rataRata,2) }}

                                </td>

                            </tr>


                        </table>


                    </div>







                    {{-- NILAI AKHIR --}}


                    <div class="bg-blue-50 rounded-xl flex items-center justify-center">


                        <div class="text-center">


                            <p class="text-blue-700 font-bold text-xl">

                                NILAI AKHIR MUTU (P)

                            </p>



                            <p class="text-6xl font-bold text-[#003B5C] mt-4">

                                {{ number_format($rataRata,1) }}

                            </p>


                            <p class="font-semibold">

                                (DIBULATKAN 0.5)

                            </p>


                        </div>


                    </div>



                </div>

                {{-- DOKUMEN HASIL PENGUJIAN --}}

                <div class="mt-10 border-t pt-8">


                    <h3 class="text-lg font-bold text-[#003B5C] mb-5">
                        Dokumen Hasil Pengujian
                    </h3>



                    <div class="grid md:grid-cols-3 gap-5">


                                {{-- PDF --}}

                            <a

        href="{{ route('admin.test_sessions.exportPdf',$testSession->id) }}"

        class="
        bg-red-600
        hover:bg-red-700
        text-white
        font-bold
        px-6
        py-3
        rounded-xl
        shadow
        inline-flex
        items-center
        gap-2
        "

        >

        📄 Download PDF

        </a>




                        {{-- EXCEL --}}

                        <a href="{{ route('admin.test_sessions.exportExcel',$testSession->id) }}"
                            class="
flex
items-center
justify-center
gap-3

bg-green-600
hover:bg-green-700

text-white
font-bold

px-6
py-4

rounded-xl

shadow
transition
">

                            📊 Export Excel

                        </a>






                        {{-- PRINT --}}

                        <button
                            onclick="window.print()"

                            class="
flex
items-center
justify-center
gap-3

bg-[#003B5C]

hover:bg-[#002B45]

text-white

font-bold

px-6
py-4

rounded-xl

shadow

transition
">

                            🖨️ Cetak Laporan

                        </button>


                    </div>


                </div>


            </div>






        </div>


    </div>


    </div>



</x-app-layout>