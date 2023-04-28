@extends('layouts.dashboard')

@section('content')
    <div class="p-8">
        <h2 class="text-4xl mb-6 font-extrabold dark:text-white">Create Menu</h2>
        {{-- header image --}}
        <form method="post" action="{{ route('menu.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid p-5 mb-6 rounded-lg gap-4 grid-cols-2 bg-white">
                {{-- startLeftSide --}}
                <div class="flex flex-col">
                    <div
                        class="flex flex-col mb-6 items-center bg-white border rounded-lg shadow-md md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        {{-- <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="{{ asset('collection-images/' . $collection->suit_img) }}" alt=""> --}}
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Menu image
                            </label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                name="image" value="{{ old('image') }}" id="image" type="file">
                            @error('image')
                                <h1 class="text-red-700">{{ $message }}</h1>
                            @enderror
                            <p class="mt-1 mb-5 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG
                                or GIF (MAX.
                                20mb).
                            </p>
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="relative">
                            <input type="text" id="floating_outlined" value="{{ old('name') }}" name="name"
                                class="block px-2.5 pb-2.5 pt-4 w-56 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="floating_outlined"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Name menu
                            </label>
                        </div>
                        @error('name')
                            <h1 class="text-red-700">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                Rp
                            </span>
                            <div class="relative">
                                <input type="number" id="floating_outlined" value="{{ old('price') }}" name="price"
                                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-r-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " />
                                <label for="floating_outlined"
                                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Price</label>
                            </div>
                        </div>
                        @error('price')
                            <h1 class="text-red-700">{{ $message }}</h1>
                        @enderror
                    </div>
                </div>
                {{-- endLeftSide --}}
                {{-- startRightSide --}}
                <div class="w-2/2">
                    <div class="mb-6">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            value="{{ old('categories_id') }}">Select
                            an option</label>
                        <select id="category" name="categories_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a category</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="message" name="desc" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here...">{{ $item->desc }}</textarea>
                    </div>
                </div>
                <button type="submit"
                    class="w-2/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
            </div>
            {{-- endRightSide --}}
        </form>
    </div>
@endsection
