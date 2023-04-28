@extends('layouts.frontend')

@section('content')
    <div class="md:mt-32 mt-28 container mx-auto">
        <h5 class="mb-10 md:text-4xl text-2xl font-bold tracking-tight text-center text-gray-900 dark:text-white">Store Kami</h5>
        <div class="flex flex-wrap justify-center items-center gap-5">
            @foreach ($location as $item)           
                <div class="flex flex-col overflow-hidden relative drop-shadow-2xl ">
                    <div class="absolute inset-y-0 right-0 w-fit md:h-20 h-12 md:p-6 p-3 backdrop-blur-lg rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div>
                            <h5 class="md:text-2xl text-md font-bold tracking-tight text-right text-gray-900 dark:text-white">{{ $item->store }}</h5>
                        </div>
                    </div>
                    @php
                        echo $item->embed
                    @endphp
                </div>
            @endforeach
        </div>
    </div>
@endsection