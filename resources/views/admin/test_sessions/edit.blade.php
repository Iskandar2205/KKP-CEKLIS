<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800">
            Edit Sesi Pengujian
        </h2>

    </x-slot>



    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow rounded-lg p-6">



                <form action="{{ route('admin.test_sessions.update',$testSession->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')



                    <div class="mb-4">

                        <label class="block font-medium mb-2">
                            Pilih Sample
                        </label>


                        <select name="sample_id"
                            class="w-full border rounded p-2">


                            @foreach($samples as $sample)


                            <option value="{{ $sample->id }}"

                                @if($sample->id == $testSession->sample_id)
                                selected
                                @endif

                                >

                                {{ $sample->product->nama_produk }}
                                -
                                {{ $sample->nomor_sample }}

                            </option>


                            @endforeach


                        </select>


                    </div>





                    <div class="mb-4">


                        <label class="block font-medium mb-2">

                            Tanggal Pengujian

                        </label>


                        <input type="date"

                            name="tanggal_pengujian"

                            value="{{ $testSession->tanggal_pengujian }}"

                            class="w-full border rounded p-2">


                    </div>







                    <div class="mb-4">


                        <label class="block font-medium mb-2">

                            Status

                        </label>


                        <select name="status"

                            class="w-full border rounded p-2">


                            <option value="draft"
                                @if($testSession->status=='draft')
                                selected
                                @endif
                                >
                                Draft
                            </option>



                            <option value="dibuka"
                                @if($testSession->status=='dibuka')
                                selected
                                @endif
                                >
                                Dibuka
                            </option>



                            <option value="selesai"
                                @if($testSession->status=='selesai')
                                selected
                                @endif
                                >
                                Selesai
                            </option>



                        </select>


                    </div>







                    <div class="mb-4">


                        <label class="block font-medium mb-2">

                            Catatan

                        </label>


                        <textarea

                            name="catatan"

                            class="w-full border rounded p-2">{{ $testSession->catatan }}</textarea>


                    </div>







                    <button

                        class="bg-blue-600 text-white px-4 py-2 rounded">

                        Update

                    </button>




                    <a href="{{ route('admin.test_sessions.index') }}"

                        class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">

                        Kembali

                    </a>



                </form>



            </div>


        </div>

    </div>


</x-app-layout>