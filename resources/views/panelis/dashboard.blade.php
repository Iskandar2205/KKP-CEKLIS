<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard Panelis
        </h2>

    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-lg font-bold">
                    Selamat datang, {{ $user->name }}
                </h3>


                <p class="mt-2">
                    Halaman panelis untuk melakukan penilaian organoleptik.
                </p>


                <p class="mt-2">
                    Role:
                    <b>{{ $user->role }}</b>
                </p>

            </div>

        </div>

    </div>


</x-app-layout>