<x-app-layout>


    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800">
            Sesi Pengujian
        </h2>

    </x-slot>





    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow-sm rounded-lg p-6">





                <div class="flex justify-between items-center mb-6">


                    <h3 class="text-lg font-bold">

                        Daftar Pengujian

                    </h3>




                    <a href="{{ route('admin.test_sessions.create') }}"

                       class="bg-blue-600 hover:bg-blue-700 
                       text-white px-4 py-2 rounded-lg">

                        + Buat Pengujian

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
                                Produk
                            </th>


                            <th class="border p-3">
                                Sample
                            </th>


                            <th class="border p-3">
                                Tanggal
                            </th>


                            <th class="border p-3">
                                Status
                            </th>


                            <th class="border p-3">
                                Aksi
                            </th>


                        </tr>


                    </thead>





                    <tbody>


                    @forelse($sessions as $session)


                        <tr>


                            <td class="border p-3 text-center">

                                {{ $loop->iteration }}

                            </td>





                            <td class="border p-3">

                                {{ $session->sample->product->nama_produk ?? '-' }}

                            </td>





                            <td class="border p-3">

                                {{ $session->sample->nomor_sample ?? '-' }}

                            </td>





                            <td class="border p-3">

                                {{ \Carbon\Carbon::parse($session->tanggal_pengujian)->format('d-m-Y') }}

                            </td>





                            <td class="border p-3 text-center">


                                @if($session->status == 'draft')


                                    <span class="bg-yellow-200 text-yellow-800 
                                    px-3 py-1 rounded-full text-sm">

                                        Draft

                                    </span>



                                @elseif($session->status == 'dibuka')


                                    <span class="bg-green-200 text-green-800 
                                    px-3 py-1 rounded-full text-sm">

                                        Dibuka

                                    </span>



                                @else


                                    <span class="bg-gray-200 text-gray-800 
                                    px-3 py-1 rounded-full text-sm">

                                        Selesai

                                    </span>


                                @endif


                            </td>







                            <td class="border p-3 text-center">


                                <div class="flex justify-center gap-2">



                                    {{-- Detail --}}

                                    <a href="{{ route('admin.test_sessions.show',$session->id) }}"

                                       class="bg-blue-600 hover:bg-blue-700 
                                       text-white px-3 py-1 rounded">

                                        Detail

                                    </a>


                                    {{-- Kontrol Status --}}

@if($session->status == 'draft')


<form action="{{ route('admin.test_sessions.open',$session->id) }}"
      method="POST"
      class="inline">

    @csrf

    <button
    class="bg-green-600 text-white px-3 py-1 rounded">

        Buka

    </button>


</form>



@elseif($session->status == 'dibuka')


<form action="{{ route('admin.test_sessions.finish',$session->id) }}"
      method="POST"
      class="inline">

    @csrf

    <button
    class="bg-gray-700 text-white px-3 py-1 rounded">

        Selesai

    </button>


</form>


@endif


                                    {{-- Edit --}}

                                    <a href="{{ route('admin.test_sessions.edit',$session->id) }}"

                                       class="bg-yellow-500 hover:bg-yellow-600
                                       text-white px-3 py-1 rounded">

                                        Edit

                                    </a>





                                    {{-- Hapus --}}

                                    <form action="{{ route('admin.test_sessions.destroy',$session->id) }}"

                                          method="POST">


                                        @csrf

                                        @method('DELETE')



                                        <button

                                        onclick="return confirm('Hapus sesi ini?')"

                                        class="bg-red-600 hover:bg-red-700
                                        text-white px-3 py-1 rounded">


                                            Hapus


                                        </button>


                                    </form>



                                </div>


                            </td>



                        </tr>



                    @empty



                        <tr>


                            <td colspan="6"

                                class="border p-5 text-center text-gray-500">


                                Belum ada sesi pengujian


                            </td>


                        </tr>



                    @endforelse



                    </tbody>



                </table>



            </div>


        </div>


    </div>



</x-app-layout> 