@extends('layouts.frontend')

@section('content')
    <div class="relative md:mt-32 mt-20 container mx-auto">
        <div class="absolute left-0 top-0 w-full h-full bg-center bg-cover"
            style='background-image: url({{ asset('store-image/' . $hero->hero_image) }});'>
        </div>
        <div class="w-full flex md:flex-row flex-col-reverse p-10 gap-4">
            {{-- left side menu --}}
            <div class="w-full flex flex-col">
                <div class="h-fit backdrop-blur-lg bg-white/40 p-10 shadow-2xl">
                    <h2 id="alice" class="md:text-4xl text-2xl uppercase text-center font-bold mb-10">adiksi menu</h2>
                    @foreach ($categories as $category)
                        <div class="flex flex-row">
                            <h2 id="alice" class="text-4xl font-bold mt-4">{{ $category->name }}</h2>
                            <div class="md:text-3xl self-end ml-3 -translate-y-1 text-xl">
                                @php
                                    echo $category->icon;
                                @endphp
                            </div>
                        </div>
                        <hr class="mt-1 mb-3">
                        <ul>
                            @foreach ($category->item as $item)
                                <div class="flex flex-row justify-between gap-2">
                                    <div class="w-3/4 flex flex-col mb-2">
                                        <li id="poppins">{{ $item->name }}</li>
                                        <li id="poppins" class="text-xs text-gray-600">{{ $item->desc }}</li>
                                    </div>
                                    <div class="min-w-fit">
                                        <li id="poppins" class="text-center text-md">Rp {{ $item->price }}</li>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
            {{-- right side menu --}}
            @foreach ($index as $item)       
                <div class="w-full flex flex-col">
                    <div class="h-fit backdrop-blur-lg bg-white/40 p-10 shadow-2xl">
                        <h2 id="alice" class="md:text-4xl text-2xl uppercase text-center font-bold mb-10">our best seller menu</h2>
                        <div class="grid grid-cols-2 gap-4 md:p-0 p-5">
                            <div>
                                <figure class="relative max-w-sm cursor-pointer">
                                    <span id="blackOverlay"
                                        class="w-full h-full transition-all duration-300 absolute bg-opacity-0 text-transparent hover:text-white hover:bg-opacity-75 bg-darkblue-800">
                                        <p id="alice" class="md:px-8 px-4 md:py-5 py-2 md:text-3xl sm:text-md text-xs">
                                            {{ $item->hl_capt1 }}
                                        </p>
                                    </span>
                                    <a href="#">
                                        <img src="{{ asset('store-image/' . $item->hl_image1) }}" alt="image description">
                                    </a>
                                </figure>
                            </div>
                            <div>
                                <figure class="relative max-w-sm cursor-pointer">
                                    <span id="blackOverlay"
                                        class="w-full h-full transition-all duration-300 absolute bg-opacity-0 text-transparent hover:text-white hover:bg-opacity-75 bg-darkblue-800">
                                        <p id="alice" class="md:px-8 px-4 md:py-5 py-2 md:text-3xl sm:text-md text-xs">
                                            {{ $item->hl_capt2 }}
                                        </p>
                                    </span>
                                    <a href="#">
                                        <img src="{{ asset('store-image/' . $item->hl_image2) }}" alt="image description">
                                    </a>
                                </figure>
                            </div>
                            <div>
                                <figure class="relative max-w-sm cursor-pointer">
                                    <span id="blackOverlay"
                                        class="w-full h-full transition-all duration-300 absolute bg-opacity-0 text-transparent hover:text-white hover:bg-opacity-75 bg-darkblue-800">
                                        <p id="alice" class="md:px-8 px-4 md:py-5 py-2 md:text-3xl sm:text-md text-xs">
                                            {{ $item->hl_capt3 }}
                                        </p>
                                    </span>
                                    <a href="#">
                                        <img src="{{ asset('store-image/' . $item->hl_image3) }}" alt="image description">
                                    </a>
                                </figure>
                            </div>
                            <div>
                                <figure class="relative max-w-sm cursor-pointer">
                                    <span id="blackOverlay"
                                        class="w-full h-full transition-all duration-300 absolute bg-opacity-0 text-transparent hover:text-white hover:bg-opacity-75 bg-darkblue-800">
                                        <p id="alice" class="md:px-8 px-4 md:py-5 py-2 md:text-3xl sm:text-md text-xs">
                                            {{ $item->hl_capt4 }}
                                        </p>
                                    </span>
                                    <a href="#">
                                        <img src="{{ asset('store-image/' . $item->hl_image4) }}" alt="image description">
                                    </a>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
