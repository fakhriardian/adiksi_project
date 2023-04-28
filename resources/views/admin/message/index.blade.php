@extends('layouts.dashboard')

@section('content')
<div class="p-8">
    <h2 class="text-4xl mb-6 font-extrabold dark:text-white">Message</h2>
    <div class="relative overflow-x-auto mt-5 shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-3 py-3 text-center">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Subject
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($index as $item)               
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-3 text-center py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->subject }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button type="button" data-modal-target="authentication-modal-{{ $item->id }}" data-modal-toggle="authentication-modal-{{ $item->id }}"
                                class="text-darkblue-800 bg-transparent text-center hover:bg-darkblue-800 hover:text-white transition-all duration-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Show
                            </button>
                            <div id="authentication-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                <div class="relative w-full h-full max-w-2xl md:h-auto">
                                    <!-- Modal content -->
                                    <div class="max-w-2xl bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <a href="#">
                                            <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
                                        </a>
                                        <div class="p-5">
                                            <h5 class="mb-2 text-lg text-right font-bold tracking-tight text-gray-900 dark:text-white">{{ $item->name }}</h5>
                                            <p class="mb-5 font-normal text-right text-gray-700 dark:text-gray-400">{{ $item->email }}</p>
                                            <p class="mb-1 font-normal text-left text-gray-700 dark:text-gray-400">subject : {{ $item->subject }}</p>
                                            <hr class="mb-2">
                                            <p class="mb-3 font-normal text-left text-gray-700 dark:text-gray-400">{{ $item->message }}</p>
                                            <hr class="mb-2">
                                            <p class="mb-3 font-normal text-right text-gray-700 dark:text-gray-400">{{ $item->created_at }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Tidak ada pesan.
                        </th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-md-12 text-center">
            <nav aria-label="Page navigation" class="text-center">
                <ul class="pagination">
                    <li class="page-item">{{ $index->links() }}</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
