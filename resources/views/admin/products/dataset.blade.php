<x-app-layout>


    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold text-[#003B5C]">
                Template Penilaian Organoleptik
            </h2>

            <p class="text-sm text-gray-500">
                Upload template form penilaian organoleptik
            </p>

        </div>

    </x-slot>



    <div class="min-h-screen bg-[#F2FAFC] py-10">


        <div class="max-w-5xl mx-auto px-6">



            {{-- HEADER --}}

            <div class="
bg-gradient-to-r
from-[#003B5C]
to-[#0077B6]
rounded-3xl
p-8
text-white
shadow-lg
mb-8
">


                <p class="
text-xs
uppercase
tracking-widest
text-blue-200
">

                    TEMPLATE PRODUK

                </p>


                <h1 class="
text-3xl
font-bold
mt-3
">

                    {{ $product->nama_produk }}

                </h1>


                <p class="
mt-3
text-blue-100
">

                    Upload template Excel score sheet sebagai dasar form penilaian panelis.

                </p>


            </div>





            @if(session('success'))

            <div class="
bg-green-100
border
border-green-300
text-green-700
p-4
rounded-xl
mb-6
">

                {{ session('success') }}

            </div>

            @endif





            {{-- UPLOAD TEMPLATE --}}

            <div class="
bg-white
rounded-3xl
shadow-lg
p-8
">


                <h2 class="
text-xl
font-bold
text-[#003B5C]
mb-2
">

                    Upload Template Penilaian

                </h2>


                <p class="
text-gray-500
mb-6
">

                    Gunakan file Excel template score sheet hasil uji organoleptik.

                </p>




                <form

                    action="{{ route('admin.products.dataset.import',$product->id) }}"

                    method="POST"

                    enctype="multipart/form-data">


                    @csrf



                    <div class="
border-2
border-dashed
border-[#0077B6]
rounded-2xl
p-8
text-center
bg-[#F7FCFD]
">


                        <div class="text-5xl mb-4">

                            📄

                        </div>



                        <h3 class="
font-bold
text-[#003B5C]
">

                            Upload File Template

                        </h3>


                        <p class="
text-sm
text-gray-500
mt-2
mb-5
">

                            File Excel template penilaian organoleptik (.xlsx / .xls)

                        </p>



                        <input

                            type="file"

                            name="file"

                            accept=".xlsx,.xls"

                            class="
mx-auto
border
rounded-xl
p-3
w-full
"

                            required>



                    </div>





                    <button

                        type="submit"

                        class="
mt-6
bg-[#0077B6]
text-white
px-8
py-3
rounded-xl
font-semibold
hover:bg-[#005B8A]
transition
">

                        Upload Template

                    </button>



                </form>



            </div>






            {{-- INFORMASI TEMPLATE TERUPLOAD --}}


            @if(isset($template) && $template)


            <div class="
bg-blue-50
border
border-blue-200
rounded-2xl
p-5
mt-8
">


                <h3 class="
font-bold
text-[#003B5C]
">

                    Template Aktif

                </h3>


                <p class="text-sm text-gray-600 mt-2">

                    Nama File :

                    <b>
                        {{ $template->file_template }}
                    </b>

                </p>


            </div>


            @endif







            {{-- PREVIEW EXCEL --}}


            @if(isset($rows) && count($rows) > 0)



            <div class="
bg-white
rounded-3xl
shadow-lg
p-8
mt-8
">


                <h2 class="
text-xl
font-bold
text-[#003B5C]
mb-5
">

                    Preview Isi Template Excel

                </h2>



                <div class="overflow-x-auto">


                    <table class="
min-w-full
border
border-gray-300
">


                        <tbody>


                            @foreach($rows as $row)


                            <tr>


                                @foreach($row as $cell)


                                <td class="
border
px-4
py-2
text-sm
whitespace-nowrap
">

                                    {{ $cell }}

                                </td>


                                @endforeach


                            </tr>


                            @endforeach



                        </tbody>


                    </table>


                </div>



            </div>



            @else


            <div class="
bg-gray-50
border
border-gray-200
rounded-2xl
p-5
mt-8
text-gray-500
">

                Belum ada preview template Excel.

                Silakan upload file Excel terlebih dahulu.

            </div>


            @endif






        </div>


    </div>


</x-app-layout>