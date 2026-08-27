<nav x-data="{ open: false }" 
class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">


            {{-- Logo --}}

            <div class="flex items-center">

                <a href="
                    @if(auth()->user()->role === 'admin')
                        {{ route('admin.dashboard') }}
                    @elseif(auth()->user()->role === 'panelis')
                        {{ route('panelis.dashboard') }}
                    @elseif(auth()->user()->role === 'pimpinan')
                        {{ route('pimpinan.dashboard') }}
                    @endif
                "
                class="text-xl font-bold text-gray-800 dark:text-white">

                    BPPMHKP

                </a>

            </div>





            {{-- Desktop Menu --}}

            <div class="hidden sm:flex sm:items-center sm:space-x-8">



                {{-- Dashboard --}}

                <a href="
                    @if(auth()->user()->role === 'admin')
                        {{ route('admin.dashboard') }}
                    @elseif(auth()->user()->role === 'panelis')
                        {{ route('panelis.dashboard') }}
                    @elseif(auth()->user()->role === 'pimpinan')
                        {{ route('pimpinan.dashboard') }}
                    @endif
                "
                class="inline-flex items-center px-1 pt-1 text-sm font-medium">

                    Dashboard

                </a>





                {{-- Menu Admin --}}

                @if(auth()->user()->role === 'admin')


                    <a href="{{ route('admin.products.index') }}"
                    class="inline-flex items-center px-1 pt-1 text-sm font-medium">

                        Produk

                    </a>



                    <a href="{{ route('admin.test_sessions.index') }}"
                    class="inline-flex items-center px-1 pt-1 text-sm font-medium">

                        Pengujian

                    </a>



                    <a href="{{ route('admin.criteria_options.index') }}"
                    class="inline-flex items-center px-1 pt-1 text-sm font-medium">

                        Skala Penilaian

                    </a>


                @endif



            </div>








            {{-- User Dropdown --}}

            <div class="hidden sm:flex sm:items-center">


                <x-dropdown align="right" width="48">


                    <x-slot name="trigger">


                        <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500">


                            <div>

                                {{ Auth::user()->name }}

                            </div>


                            <div class="ms-1">


                                <svg class="fill-current h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">


                                    <path fill-rule="evenodd"

                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"

                                    clip-rule="evenodd" />


                                </svg>


                            </div>


                        </button>


                    </x-slot>





                    <x-slot name="content">


                        <div class="px-4 py-2 text-sm text-gray-700">


                            {{ Auth::user()->name }}

                            <br>


                            <span class="text-xs">

                                Role :
                                {{ Auth::user()->role }}

                            </span>


                        </div>



                        <hr>




                        <form method="POST" action="{{ route('logout') }}">

                            @csrf


                            <x-dropdown-link href="{{ route('logout') }}"

                            onclick="event.preventDefault();
                            this.closest('form').submit();">


                                Logout


                            </x-dropdown-link>


                        </form>



                    </x-slot>



                </x-dropdown>



            </div>





        </div>

    </div>









{{-- Mobile Menu --}}

<div 
:class="{'block': open, 'hidden': !open}"
class="hidden sm:hidden">


    <div class="pt-2 pb-3 space-y-1">


        <a href="
            @if(auth()->user()->role === 'admin')
                {{ route('admin.dashboard') }}
            @elseif(auth()->user()->role === 'panelis')
                {{ route('panelis.dashboard') }}
            @elseif(auth()->user()->role === 'pimpinan')
                {{ route('pimpinan.dashboard') }}
            @endif
        "
        class="block px-4 py-2 text-gray-700">


            Dashboard


        </a>


    </div>





    <div class="border-t pt-4 pb-3">


        <div class="px-4">


            <div class="font-medium">

                {{ Auth::user()->name }}

            </div>


            <div class="text-sm text-gray-500">

                {{ Auth::user()->email }}

            </div>


        </div>





        <div class="mt-3">


            <form method="POST" action="{{ route('logout') }}">

                @csrf


                <a href="{{ route('logout') }}"

                onclick="event.preventDefault();
                this.closest('form').submit();"

                class="block px-4 py-2 text-gray-700">


                    Logout


                </a>


            </form>


        </div>


    </div>



</div>


</nav>