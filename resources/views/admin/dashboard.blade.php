<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard Admin
        </h2>

    </x-slot>



    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            {{-- Welcome Card --}}

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <div class="p-6 text-gray-900">


                    <h3 class="text-lg font-bold">

                        Selamat datang,
                        {{ $user->name }}

                    </h3>



                    <p class="mt-2">

                        Sistem Uji Organoleptik BPPMHKP

                    </p>



                    <p class="mt-2">

                        Role:

                        <strong>
                            {{ $user->role }}
                        </strong>

                    </p>



                </div>


            </div>








            {{-- Menu Admin --}}


            <div class="mt-6 bg-white shadow-sm sm:rounded-lg">


                <div class="p-6">


                    <h3 class="text-lg font-bold mb-5">

                        Menu Admin

                    </h3>





                    <div class="flex gap-5 flex-wrap">



                        {{-- Master Produk --}}


                        <a href="{{ route('admin.products.index') }}"

                           class="bg-blue-600 hover:bg-blue-700 
                           text-white font-medium
                           px-5 py-3 rounded-lg shadow">


                            📦 Master Produk


                        </a>







                        {{-- Master Sample --}}


                        <a href="{{ route('admin.samples.index') }}"

                           class="bg-green-600 hover:bg-green-700 
                           text-white font-medium
                           px-5 py-3 rounded-lg shadow">


                            🧪 Master Sample


                        </a>







                        {{-- Master Skala Penilaian --}}


                        <a href="{{ route('admin.criteria_options.index') }}"

                           class="bg-purple-600 hover:bg-purple-700 
                           text-white font-medium
                           px-5 py-3 rounded-lg shadow">


                            ⭐ Skala Penilaian


                        </a>





                    </div>


                </div>


            </div>





        </div>


    </div>


</x-app-layout>