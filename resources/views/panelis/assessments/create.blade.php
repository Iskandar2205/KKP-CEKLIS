@foreach($template->sections as $section)

<div class="bg-white rounded-3xl shadow p-8 mb-8">


    <h2 class="text-xl font-bold text-[#003B5C] mb-6">
        {{ $section->nama_section }}
    </h2>



    @foreach($section->criterias as $criteria)


    <div class="mb-10">


        <div class="flex items-center justify-between mb-5">


            <h3 class="font-bold text-lg text-gray-800">
                {{ $criteria->nama_kriteria }}
            </h3>


            <span class="text-sm text-gray-400">
                Pilih satu nilai
            </span>


        </div>




        <div class="space-y-4">


            @foreach($criteria->options as $option)


            <label class="block cursor-pointer">


                <input
                    type="radio"
                    name="criteria[{{ $criteria->id }}]"
                    value="{{ $option->nilai }}"
                    class="peer hidden"
                    required
                >




                <div class="
                    flex
                    items-center
                    gap-5

                    w-full

                    border
                    border-gray-200

                    rounded-xl

                    px-5
                    py-4

                    bg-white

                    shadow-sm

                    transition-all
                    duration-200

                    hover:border-[#0077B6]
                    hover:shadow-md

                    peer-checked:border-[#0077B6]
                    peer-checked:bg-blue-50
                ">



                    {{-- RADIO BUTTON --}}

                    <div class="
                        w-6
                        h-6

                        rounded-full

                        border-2
                        border-gray-300

                        flex
                        items-center
                        justify-center

                        shrink-0
                    ">

                        <div class="
                            w-3
                            h-3

                            rounded-full

                            bg-[#0077B6]

                            hidden
                        ">
                        </div>

                    </div>





                    {{-- NILAI --}}

                    <div class="
                        w-12
                        text-center
                        shrink-0
                    ">

                        <span class="
                            text-3xl
                            font-bold
                            text-[#0077B6]
                        ">

                            {{ $option->nilai }}

                        </span>


                    </div>






                    {{-- DESKRIPSI --}}

                    <div class="flex-1">


                        <p class="
                            text-base
                            font-medium
                            text-gray-700
                            leading-relaxed
                        ">

                            {{ $option->deskripsi }}

                        </p>


                    </div>



                </div>


            </label>


            @endforeach


        </div>


    </div>


    @endforeach


</div>


@endforeach



<div class="flex justify-end mt-8">


<button
    type="submit"

    class="
        bg-[#0077B6]
        hover:bg-[#005B8A]

        text-white

        font-bold

        px-10
        py-3

        rounded-xl

        shadow-lg

        transition
    "
>

    Simpan Penilaian

</button>


</div>