@extends('layouts.dashboard')

@section('content')
    {{-- success alert --}}
    @if (session()->has('success'))
        <div id="alert-3" class="flex p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    @endif

    <div class="p-8">
        <h2 class="text-4xl mb-6 font-extrabold dark:text-white">Menu Edit</h2>
        <div class="flex flex-row justify-between w-full">
            <a href="{{ route('menu.create') }}"
                class="text-white my-auto bg-blue-700 text-center hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Create
            </a>
        </div>

        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="menu-tab" data-tabs-target="#menu" type="button" role="tab" aria-controls="menu" aria-selected="false">Menu</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="draft-tab" data-tabs-target="#draft" type="button" role="tab" aria-controls="draft" aria-selected="false">Draft</button>
                </li>
            </ul>
        </div>
        <div id="myTabContent">
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="menu" role="tabpanel" aria-labelledby="menu-tab">
                <form method="GET">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input type="search" name="search_publish" value="{{ request('search_publish') }}" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                    </div>
                </form>
                <div class="relative overflow-x-auto mt-5 shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class=" px-6 py-3">
                                    no
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    image
                                </th>
                                <th scope="col" class="px-6 w-40 py-3">
                                    name
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    price
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    <span>action</span>
                                </th>
                            </tr>
                        </thead>
                        @forelse ($publish as $row)
                            <tbody>
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-6 py-3 font-medium flex flex-row text-gray-900 whitespace-nowrap dark:text-white">
                                        <img class="w-20 mr-10" src="{{ asset('store-image/' . $row->image) }}" alt="Bonnie image" />
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $row->name }}
                                    </td>
                                    <td class="px-4 py-4">
                                        {{ $row->categories->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp {{ $row->price }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('menu.destroy', $row->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <div class="flex gap-2 justify-center">
                                                <a href="{{ route('menu.edit', $row->id) }}"
                                                    class="text-white bg-blue-700 text-center hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                    Edit
                                                </a>
                                                <a href="{{ route('draft', $row->id) }}" onclick="return confirm('move item to draft?')"
                                                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">
                                                    Draft
                                                </a>
                                                <button type="submit" onclick="return confirm('yakin ingin menghapus?')"
                                                    class="focus:outline-none my-auto text-white bg-red-700 max-h-12 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                    Delete
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        @empty
                            <tbody>
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th colspan="6" scope="row" class="px-6 py-4">
                                        tidak ada
                                    </th>
                                </tr>
                            </tbody>
                        @endforelse
                    </table>
                    <div class="row mt-5 mb-5">
                        <div class="col-md-12 text-center">
                            <nav aria-label="Page navigation" class="text-center">
                                <ul class="pagination">
                                    <li class="page-item">{{ $publish->links() }}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="draft" role="tabpanel" aria-labelledby="draft-tab">
                <form method="GET">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input type="search" name="search_draft" value="{{ request('search_draft') }}" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                    </div>
                </form>
                <div class="relative overflow-x-auto mt-5 shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class=" px-6 py-3">
                                    no
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    image
                                </th>
                                <th scope="col" class="px-6 w-40 py-3">
                                    name
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    price
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    <span>action</span>
                                </th>
                            </tr>
                        </thead>
                        @foreach ($draft as $row)
                            <tbody>
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-6 py-3 font-medium flex flex-row text-gray-900 whitespace-nowrap dark:text-white">
                                        <img class="w-20 mr-10" src="{{ asset('store-image/' . $row->image) }}" alt="Bonnie image" />
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $row->name }}
                                    </td>
                                    <td class="px-4 py-4">
                                        {{ $row->categories->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp {{ $row->price }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('menu.destroy', $row->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <div class="flex gap-5 justify-center">
                                                <a href="{{ route('menu.edit', $row->id) }}"
                                                    class="text-white bg-blue-700 text-center hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                    Edit
                                                </a>
                                                <a href="{{ route('publish', $row->id) }}" onclick="return confirm('publish item?')"
                                                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">
                                                    Publish
                                                </a>
                                                <button type="submit" onclick="return confirm('yakin ingin menghapus?')"
                                                    class="focus:outline-none my-auto text-white bg-red-700 max-h-12 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                    Delete
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <div class="row mt-5 mb-5">
                        <div class="col-md-12 text-center">
                            <nav aria-label="Page navigation" class="text-center">
                                <ul class="pagination">
                                    <li class="page-item">{{ $draft->links() }}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
