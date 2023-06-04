@extends('layouts.frontend')

@section('content')
    <div class="md:mt-32 mt-20 container mx-auto overflow-hidden">
        @foreach ($index as $item)
            <div
                class="flex flex-col items-center h-full lg:h-[80vh] overflow-y-hidden md:flex-row md:max-w-full transition-all duration-500 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-1/2 md:rounded-none md:rounded-l-lg"
                    src="{{ asset('store-image/' . $item->hero_image) }}" alt="hero_image">
                <div class="flex flex-col justify-between lg:p-24 md:p-14 p-5 leading-normal">
                    <h6 id="poppins" class="mb-8 italic lg:text-md text-sm tracking-tight text-gray-700 dark:text-white">
                        {{ $item->hero_caption }}
                    </h6>
                    <h5 class="font-alice mb-10 lg:text-7xl text-4xl font-bold tracking-tight text-gray-700 dark:text-white">
                        {{ $item->hero_head }}
                    </h5>
                    <p id="poppins" class="mb-3 lg:text-lg text-sm font-normal text-gray-700 dark:text-gray-400">
                        {{ $item->hero_desc }}
                    </p>
                </div>
            </div>

            <div class="lg:p-20 p-5 flex lg:mt-32 mt-0 flex-col items-center justify-between h-full lg:h-[60vh] overflow-y-hidden md:flex-row w-full bg-darkblue-800">
                <div class="flex flex-col md:p-14 p-0 md:mb-0 mb-10 w-full justify-center">
                    <h5 class="font-alice lg:text-6xl lg:w-[50vh] w-full text-3xl font-bold tracking-tight text-white delay-[300ms] duration-[600ms] taos:translate-x-[-200px] taos:opacity-0" data-taos-offset="300">
                        {{ $item->card_head }}
                    </h5>
                    <p id="poppins" class="mt-10 lg:text-lg lg:w-[60vh] w-full text-sm font-normal text-white delay-[300ms] duration-[600ms] taos:translate-x-[-100%] taos:invisible" data-taos-offset="200">
                        {{ $item->card_desc }}
                    </p>
                </div>
                <figure class="relative max-w-sm delay-[300ms] duration-[600ms] taos:translate-y-[200px] taos:opacity-0" data-taos-offset="300">
                    <img src="{{ asset('store-image/' . $item->card_image) }}" alt="image description">
                    <figcaption class="absolute px-4 text-lg text-white bottom-6">
                        <button data-tooltip-target="tooltip-no-arrow" data-tooltip-placement="bottom" type="button"
                            class="text-gold-800 bg-white z-10 hover:bg-gray-50 rounded-full md:-translate-y-40 -translate-y-0 md:-translate-x-[50px] -translate-x-0 p-5 animate-bounce">
                            <svg aria-hidden="true" class="w-5 h-5s text-gold-800 dark:text-gray-600" viewBox="0 0 24 27" sfill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                        <div id="tooltip-no-arrow" role="tooltip"
                            class="absolute p-12 leading-normal invisible inline-block w-80 md:text-lg text-sm font-medium text-black bg-white drop-shadow-lg opacity-90 tooltip">
                            {{ $item->card_quote }}
                        </div>
                    </figcaption>
                </figure>
            </div>

            <div class="flex w-full md:flex-row flex-col justify-center">
                <h3 class="font-alice md:p-20 p-5 my-auto font-bold md:w-[70vh] w-full md:text-5xl text-3xl delay-[300ms] duration-[600ms] taos:translate-x-[-200px] taos:opacity-0" data-taos-offset="300">
                    {{ $item->hl_head }}
                </h3>
                <h5 id="poppins" class="md:p-20 p-5 my-auto md:w-1/2 w-full text-gray-500 lg:text-xl text-md delay-[300ms] duration-[600ms] taos:translate-x-[200px] taos:opacity-0" data-taos-offset="400">
                    {{ $item->hl_desc }}
                </h5>
            </div>
            <div class="grid grid-cols-4 gap-4 md:p-0 p-5">
                <div>
                    <figure class="relative max-w-sm cursor-pointer delay-[300ms] duration-[600ms] taos:[transform:translate3d(0,200px,0)_scale(0.6)] taos:opacity-0" data-taos-offset="50">
                        <span id="blackOverlay"
                            class="w-full h-full transition-all duration-300 absolute bg-opacity-0 text-transparent hover:text-white hover:bg-opacity-75 bg-darkblue-800">
                            <p class="font-alice md:px-8 px-4 md:py-5 py-2 md:text-3xl sm:text-md text-xs">
                                {{ $item->hl_capt1 }}
                            </p>
                        </span>
                        <a href="#">
                            <img src="{{ asset('store-image/' . $item->hl_image1) }}" alt="image description">
                        </a>
                    </figure>
                </div>
                <div>
                    <figure class="relative max-w-sm cursor-pointer delay-[300ms] duration-[600ms] taos:[transform:translate3d(0,200px,0)_scale(0.6)] taos:opacity-0" data-taos-offset="100">
                        <span id="blackOverlay"
                            class="w-full h-full transition-all duration-300 absolute bg-opacity-0 text-transparent hover:text-white hover:bg-opacity-75 bg-darkblue-800">
                            <p class="font-alice md:px-8 px-4 md:py-5 py-2 md:text-3xl sm:text-md text-xs">
                                {{ $item->hl_capt2 }}
                            </p>
                        </span>
                        <a href="#">
                            <img src="{{ asset('store-image/' . $item->hl_image2) }}" alt="image description">
                        </a>
                    </figure>
                </div>
                <div>
                    <figure class="relative max-w-sm cursor-pointer delay-[300ms] duration-[600ms] taos:[transform:translate3d(0,200px,0)_scale(0.6)] taos:opacity-0" data-taos-offset="125">
                        <span id="blackOverlay"
                            class="w-full h-full transition-all duration-300 absolute bg-opacity-0 text-transparent hover:text-white hover:bg-opacity-75 bg-darkblue-800">
                            <p class="font-alice md:px-8 px-4 md:py-5 py-2 md:text-3xl sm:text-md text-xs">
                                {{ $item->hl_capt3 }}
                            </p>
                        </span>
                        <a href="#">
                            <img src="{{ asset('store-image/' . $item->hl_image3) }}" alt="image description">
                        </a>
                    </figure>
                </div>
                <div>
                    <figure class="relative max-w-sm cursor-pointer delay-[300ms] duration-[600ms] taos:[transform:translate3d(0,200px,0)_scale(0.6)] taos:opacity-0" data-taos-offset="150">
                        <span id="blackOverlay"
                            class="w-full h-full transition-all duration-300 absolute bg-opacity-0 text-transparent hover:text-white hover:bg-opacity-75 bg-darkblue-800">
                            <p class="font-alice md:px-8 px-4 md:py-5 py-2 md:text-3xl sm:text-md text-xs">
                                {{ $item->hl_capt4 }}
                            </p>
                        </span>
                        <a href="#">
                            <img src="{{ asset('store-image/' . $item->hl_image4) }}" alt="image description">
                        </a>
                    </figure>
                </div>
            </div>
            <div class="flex justify-end">
                <a href="/menu" class="inline-flex items-center mt-4 justify-center px-5 py-4 text-base font-medium text-gray-500 rounded-lg bg-gray-50 transition-all duration-300 group hover:scale-110 hover:text-gray-900 hover:bg-gray-100">
                    <span class="w-full">Lihat Menu Lainnya</span>
                    <svg aria-hidden="true" class="w-6 h-6 ml-3 group-hover:scale-125 transition-all duration-300 group-hover:ml-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a> 
            </div>

            <div class="flex flex-col md:p-20 p-5 items-center md:mt-14 mt-4 lg:flex-row w-full">
                <div class="bg-cover bg-bottom md:w-[70vh] md:h-[60vh] sm:w-[70vh] sm:h-[40vh] w-80 h-80 delay-[300ms] duration-[600ms] taos:[transform:translate3d(-200px,200px,0)] taos:opacity-0" data-taos-offset="200"
                    style="background-image: url({{ asset('store-image/' . $item->mt_image) }})">
                    <div
                        class="relative sm:translate-y-16 sm:-left-20 translate-y-8 -left-12 bg-darkblue-800 bg-cover md:w-[70vh] md:h-[60vh] w-80 h-80 -z-20 delay-[300ms] duration-[600ms] taos:[transform:translate3d(-200px,200px,0)] taos:opacity-0" data-taos-offset="500">
                    </div>
                </div>
                <div class="lg:px-20 px-0 lg:mt-0 sm:mt-20 mt-14 flex flex-col justify-between p-4 leading-normal">
                    <h5 class="font-alice md:mb-12 mb-5 md:text-5xl text-2xl md:w-96 w-fit font-bold tracking-tight text-gray-900 delay-[300ms] duration-[600ms] taos:[transform:translate3d(200px,0,0)_scale(0.6)] taos:opacity-0" data-taos-offset="200">
                    {{ $item->mt_head }}
                    </h5>
                    <p class="md:mb-12 mb-5 font-normal text-gray-700 delay-[300ms] duration-[600ms] taos:[transform:translate3d(200px,0,0)_scale(0.6)] taos:opacity-0" data-taos-offset="200">
                        {{ $item->mt_desc }}
                    </p>
                    <a href="/booking-meeting-room" class="uppercase w-fit hover:underline underline-offset-8 text-gold-800 font-bold">
                        check availability
                    </a>
                </div>
            </div>
            <div class="grid lg:grid-cols-10 md:gap-4 gap-2">
                <div class="w-full md:h-80 h-full col-start-1 col-span-3 bg-gray-600 delay-[300ms] duration-[600ms] taos:[transform:translate3d(0,200px,0)_scale(1.2)] taos:opacity-0"
                data-taos-offset="200">
                    <img class="object-cover w-full h-full" src="{{ asset('store-image/' . $item->image1) }}" alt="">
                </div>
                <div class="row-span-2 col-start-4 col-span-3 w-full md:h-full h-full bg-gray-600 delay-[300ms] duration-[600ms] taos:[transform:translate3d(0,200px,0)_scale(1.2)] taos:opacity-0"
                data-taos-offset="200">
                    <img class="object-cover w-full h-full" src="{{ asset('store-image/' . $item->image2) }}" alt="">
                </div>
                <div
                    class="row-span-2 md:col-start-7 col-start-1 col-span-6 md:h-full h-72 md:row-start-1 row-start-3 bg-gray-600 delay-[300ms] duration-[600ms] taos:[transform:translate3d(0,200px,0)_scale(1.2)] taos:opacity-0"
                    data-taos-offset="200">
                    <img class="object-cover w-full h-full" src="{{ asset('store-image/' . $item->image3) }}" alt="">
                </div>
                <div class="w-full md:h-80 h-full col-start-1 col-span-3 bg-gray-600delay-[300ms] duration-[600ms] taos:[transform:translate3d(0,200px,0)_scale(1.2)] taos:opacity-0"
                data-taos-offset="10">
                    <img class="object-cover w-full h-full" src="{{ asset('store-image/' . $item->image4) }}" alt="">
                </div>
            </div>
        @endforeach
    </div>
@endsection
