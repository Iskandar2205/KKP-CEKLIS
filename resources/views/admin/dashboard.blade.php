<x-app-layout>


    





    <div class="min-h-screen bg-[#F2FAFC] py-10">


        <div class="max-w-7xl mx-auto px-6">







            {{-- HEADER SYSTEM --}}


            <div class="
relative
overflow-hidden
rounded-[30px]
bg-gradient-to-r
from-[#002B45]
via-[#005B73]
to-[#008C95]
p-10
text-white
shadow-xl
mb-10
">


                <div class="relative z-10">


                    <div class="flex justify-between items-center">


                        <div>


                            <p class="
text-xs
tracking-[0.3em]
text-blue-200
uppercase
">

                                BPPMHKP SYSTEM

                            </p>



                            <h1 class="
text-4xl
font-bold
mt-3
">

                                Ocean Quality Control

                            </h1>



                            <p class="
mt-4
text-blue-100
max-w-xl
">

                                Sistem monitoring pengujian mutu
                                hasil kelautan dan perikanan
                                secara digital dan terintegrasi.

                            </p>


                        </div>




                        <div class="
bg-white/20
backdrop-blur-xl
rounded-2xl
px-6
py-4
">


                            <p class="text-xs text-blue-100">
                                SYSTEM STATUS
                            </p>


                            <div class="
flex
items-center
gap-2
mt-2
">


                                <div class="
w-3
h-3
bg-green-400
rounded-full
animate-pulse
"></div>


                                <span class="font-bold">

                                    ONLINE

                                </span>


                            </div>


                        </div>



                    </div>


                </div>






                <div class="
absolute
right-0
bottom-0
opacity-10
">


                    <svg width="400" height="160">

                        <path
                            d="M0 100 Q100 20 200 100 T400 100"
                            stroke="white"
                            stroke-width="4"
                            fill="none" />


                    </svg>


                </div>



            </div>













            {{-- MASTER CONTROL --}}


            <div class="
bg-white
rounded-3xl
shadow-sm
p-8
mb-10
">


                <div class="flex justify-between items-center mb-6">


                    <h2 class="
text-xl
font-bold
text-[#003B5C]
">

                        Master Control

                    </h2>


                    <span class="
text-xs
text-gray-400
">


                    </span>


                </div>





                <div class="
grid
grid-cols-2
md:grid-cols-4
gap-5
">





                    <a href="{{route('admin.products.index')}}"
                        class="
group
border
rounded-2xl
p-6
hover:border-[#0077B6]
hover:shadow-md
transition
">


                        <h3 class="
font-bold
text-[#003B5C]
">

                            Produk

                        </h3>


                        <p class="
text-sm
text-gray-400
mt-2
">

                            Data produk pengujian

                        </p>


                    </a>








                    <a href="{{route('admin.samples.index')}}"
                        class="
group
border
rounded-2xl
p-6
hover:border-[#00A896]
hover:shadow-md
transition
">


                        <h3 class="
font-bold
text-[#003B5C]
">

                            Sample

                        </h3>


                        <p class="
text-sm
text-gray-400
mt-2
">

                            Data sampel uji

                        </p>


                    </a>








                    <a href="{{route('admin.criteria_options.index')}}"
                        class="
group
border
rounded-2xl
p-6
hover:border-orange-400
hover:shadow-md
transition
">


                        <h3 class="
font-bold
text-[#003B5C]
">

                            Penilaian

                        </h3>


                        <p class="
text-sm
text-gray-400
mt-2
">

                            Parameter organoleptik

                        </p>


                    </a>








                    <a href="{{route('admin.users.index')}}"
                        class="
group
border
rounded-2xl
p-6
hover:border-[#003B5C]
hover:shadow-md
transition
">


                        <h3 class="
font-bold
text-[#003B5C]
">

                            User

                        </h3>


                        <p class="
text-sm
text-gray-400
mt-2
">

                            Manajemen pengguna

                        </p>


                    </a>





                </div>


            </div>









            {{-- STATISTIK --}}


            <div class="
grid
grid-cols-1
md:grid-cols-3
gap-8
mb-10
">





                <div class="
bg-white
rounded-3xl
p-8
shadow-sm
">


                    <p class="text-xs text-gray-400 uppercase">

                        Panelis Aktif

                    </p>


                    <h1 class="
text-5xl
font-bold
text-[#003B5C]
mt-3
">

                        {{\App\Models\User::where('role','panelis')->count()}}

                    </h1>


                    <div class="
w-20
h-1
bg-[#0077B6]
mt-5
"></div>


                </div>






                <div class="
bg-white
rounded-3xl
p-8
shadow-sm
">


                    <p class="text-xs text-gray-400 uppercase">

                        Sample Terdaftar

                    </p>


                    <h1 class="
text-5xl
font-bold
text-[#003B5C]
mt-3
">

                        {{\App\Models\Sample::count()}}

                    </h1>


                    <div class="
w-20
h-1
bg-[#00A896]
mt-5
"></div>


                </div>







                <div class="
bg-white
rounded-3xl
p-8
shadow-sm
">


                    <p class="text-xs text-gray-400 uppercase">

                        Total Pengujian

                    </p>


                    <h1 class="
text-5xl
font-bold
text-[#003B5C]
mt-3
">

                        {{\App\Models\TestSession::count()}}

                    </h1>


                    <div class="
w-20
h-1
bg-[#F7941D]
mt-5
"></div>


                </div>




            </div>









            {{-- LIVE MONITOR --}}


            <div class="
grid
grid-cols-1
lg:grid-cols-3
gap-8
">





                <div class="
lg:col-span-2
bg-white
rounded-3xl
p-8
shadow-sm
">


                    <div class="
flex
justify-between
mb-6
">


                        <h2 class="
text-xl
font-bold
text-[#003B5C]
">

                            Live Testing Monitor

                        </h2>


                        <span class="
bg-green-100
text-green-700
px-3
py-1
rounded-full
text-xs
">

                            Realtime

                        </span>


                    </div>





                    @php

                    $activeTest=
                    \App\Models\TestSession::where('status','dibuka')
                    ->latest()
                    ->first();

                    @endphp






                    @if($activeTest)


                    <h3 class="
text-2xl
font-bold
text-[#003B5C]
">

                        {{$activeTest->sample->product->nama_produk ?? '-'}}

                    </h3>


                    <p class="text-gray-500 mt-2">

                        Tanggal :
                        {{$activeTest->tanggal_pengujian}}

                    </p>



                    <div class="
mt-6
bg-[#F2FAFC]
rounded-2xl
p-5
">


                        Status Pengujian

                        <br>


                        <span class="
text-green-600
font-bold
">

                            DIBUKA

                        </span>


                    </div>



                    @else


                    <div class="
text-center
text-gray-400
py-10
">

                        Tidak ada pengujian aktif

                    </div>



                    @endif



                </div>







                <div class="
bg-[#003B5C]
rounded-3xl
p-8
text-white
">


                    <h2 class="
font-bold
text-xl
mb-8
">

                        Quick Status

                    </h2>



                    <div class="space-y-6">


                        <div>

                            <p class="text-blue-200 text-sm">

                                Draft

                            </p>

                            <h2 class="text-4xl font-bold">

                                {{\App\Models\TestSession::where('status','draft')->count()}}

                            </h2>

                        </div>



                        <div>

                            <p class="text-blue-200 text-sm">

                                Berjalan

                            </p>

                            <h2 class="text-4xl font-bold">

                                {{\App\Models\TestSession::where('status','dibuka')->count()}}

                            </h2>

                        </div>



                        <div>

                            <p class="text-blue-200 text-sm">

                                Selesai

                            </p>

                            <h2 class="text-4xl font-bold">

                                {{\App\Models\TestSession::where('status','selesai')->count()}}

                            </h2>

                        </div>


                    </div>


                </div>






            </div>





        </div>

    </div>


</x-app-layout>