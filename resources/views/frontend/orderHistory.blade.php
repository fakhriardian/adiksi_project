@extends('layouts.frontend')

@section('content')

<div class="md:mt-32 mt-20 mb-10 container mx-auto">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">

    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="orderHistory-tab" data-tabs-target="#orderHistory" type="button" role="tab" aria-controls="orderHistory" aria-selected="false">Order History</button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="appointment-tab" data-tabs-target="#appointment" type="button" role="tab" aria-controls="appointment" aria-selected="false">Booking Meeting Room</button>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="orderHistory" role="tabpanel" aria-labelledby="orderHistory-tab">
            <div class="flex md:flex-row flex-col gap-2 md:items-center justify-between pb-4">
                <h3 class="text-xl font-bold">
                    Order History
                </h3>
                <form method="GET">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input type="number" name="search" value="{{ request('search') }}" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari dengan order id">
                    </div>
                </form>
            </div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>     
                        <th scope="col" class="px-2 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Order Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            payment method
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            option
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($order as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->order_id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->updated_at }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->paymentMethod }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->status == 'unpaid')
                                    <div class="badge badge-error uppercase text-md">{{ $item->status }}</div>
                                @else
                                    <div class="badge badge-accent uppercase text-md">{{ $item->status }}</div>
                                @endif
                            </td>
                            @if ($item->status == 'unpaid')
                                <td class="px-6 py-4">
                                    <p class="font-medium text-black dark:text-blue-500">Selesaikan pembayaran</p>
                                </td>
                            @else       
                                <td class="px-6 py-4">
                                    <div class="flex gap-5">
                                        @if ($item->timelines_id == '0')
                                            <p class="font-medium text-black dark:text-blue-500">Menunggu konfirmasi</p>
                                        @else
                                            <a href="#" data-modal-target="authentication-modal-{{ $item->order_id }}" data-modal-toggle="authentication-modal-{{ $item->order_id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                                        @endif
                                        <a href="{{ route('invoice', $item->order_id) }}" target="_blank" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Invoice</a>
                                    </div>
                                </td>
                            @endif
                        </tr>
                        <!-- Main modal -->
                        <div id="authentication-modal-{{ $item->order_id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                            <div class="relative w-full h-full max-w-md md:h-auto">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal-{{ $item->order_id }}">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="px-6 py-6 lg:px-8">
                                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Pesanan saya</h3>
                                        @if ($item->timelines_id == '1')
                                            <img class="rounded-t-lg max-w-sm" src="/asset/orderAccepted.jpg" alt="" />
                                            <ol class="items-center sm:flex">
                                                <li class="relative mb-6 sm:mb-0">
                                                    <div class="flex items-center">
                                                        <div class="z-10 animate-bounce flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                            <svg aria-hidden="true" class="w-3 h-3 text-blue-800 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                        </div>
                                                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                                    </div>
                                                    <div class="mt-3 sm:pr-8">
                                                        <h3 class="text-md font-semibold text-gray-900 dark:text-white">Pesanan diterima</h3>
                                                    </div>
                                                </li>
                                                <li class="relative mb-6 sm:mb-0">
                                                    <div class="flex items-center">
                                                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                            <svg aria-hidden="true" class="w-3 h-3 text-blue-800 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                        </div>
                                                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                                    </div>
                                                    <div class="mt-3 sm:pr-8">
                                                        <h3 class="text-md font-semibold text-gray-400 dark:text-white">Pesanan dalam proses</h3>
                                                    </div>
                                                </li>
                                                <li class="relative mb-6 sm:mb-0">
                                                    <div class="flex items-center">
                                                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                            <svg aria-hidden="true" class="w-3 h-3 text-blue-800 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                        </div>
                                                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                                    </div>
                                                    <div class="mt-3 sm:pr-8">
                                                        <h3 class="text-md font-semibold text-gray-400 dark:text-white">Pesanan telah selesai</h3>
                                                    </div>
                                                </li>
                                            </ol>
                                        @elseif ($item->timelines_id == '2')
                                            <img class="rounded-t-lg max-w-sm" src="/asset/process.jpeg" alt="" />
                                            <ol class="items-center sm:flex">
                                                <li class="relative mb-6 sm:mb-0">
                                                    <div class="flex items-center">
                                                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                            <svg aria-hidden="true" class="w-3 h-3 text-blue-800 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                        </div>
                                                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                                    </div>
                                                    <div class="mt-3 sm:pr-8">
                                                        <h3 class="text-md font-semibold text-gray-900 dark:text-white">Pesanan diterima</h3>
                                                    </div>
                                                </li>
                                                <li class="relative mb-6 sm:mb-0">
                                                    <div class="flex items-center">
                                                        <div class="z-10 animate-bounce flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                            <svg aria-hidden="true" class="w-3 h-3 text-blue-800 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                        </div>
                                                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                                    </div>
                                                    <div class="mt-3 sm:pr-8">
                                                        <h3 class="text-md font-semibold text-gray-900 dark:text-white">Pesanan dalam proses</h3>
                                                    </div>
                                                </li>
                                                <li class="relative mb-6 sm:mb-0">
                                                    <div class="flex items-center">
                                                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                            <svg aria-hidden="true" class="w-3 h-3 text-blue-800 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                        </div>
                                                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                                    </div>
                                                    <div class="mt-3 sm:pr-8">
                                                        <h3 class="text-md font-semibold text-gray-400 dark:text-white">Pesanan telah selesai</h3>
                                                    </div>
                                                </li>
                                            </ol>
                                        @else
                                            <img class="rounded-t-lg max-w-sm" src="/asset/done.jpg" alt="" />
                                            <ol class="items-center sm:flex">
                                                <li class="relative mb-6 sm:mb-0">
                                                    <div class="flex items-center">
                                                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                            <svg aria-hidden="true" class="w-3 h-3 text-blue-800 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                        </div>
                                                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                                    </div>
                                                    <div class="mt-3 sm:pr-8">
                                                        <h3 class="text-md font-semibold text-gray-900 dark:text-white">Pesanan diterima</h3>
                                                    </div>
                                                </li>
                                                <li class="relative mb-6 sm:mb-0">
                                                    <div class="flex items-center">
                                                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                            <svg aria-hidden="true" class="w-3 h-3 text-blue-800 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                        </div>
                                                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                                    </div>
                                                    <div class="mt-3 sm:pr-8">
                                                        <h3 class="text-md font-semibold text-gray-900 dark:text-white">Pesanan dalam proses</h3>
                                                    </div>
                                                </li>
                                                <li class="relative mb-6 sm:mb-0">
                                                    <div class="flex items-center">
                                                        <div class="z-10 animate-bounce flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                                            <svg aria-hidden="true" class="w-3 h-3 text-blue-800 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                        </div>
                                                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                                                    </div>
                                                    <div class="mt-3 sm:pr-8">
                                                        <h3 class="text-md font-semibold text-gray-900 dark:text-white">Pesanan telah selesai</h3>
                                                    </div>
                                                </li>
                                            </ol>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> 
                    @empty
                        <th colspan="6">
                            <div class="flex justify-center mt-10">
                                <div class="max-w-xl bg-white rounded-2xl mb-10 drop-shadow-2xl dark:bg-gray-800 dark:border-gray-700">
                                    <img class="rounded-t-lg" src="/asset/notfound.png" alt="" />
                                    <div class="flex justify-center gap-2 p-5">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Maaf, pesanan
                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-blue-600 dark:text-white">
                                                tidak ditemukan!
                                            </h5>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </th>
                    @endforelse
                </tbody>
            </table>
            <div class="row mt-5 mb-5">
                <div class="col-md-12 text-center">
                    <nav aria-label="Page navigation" class="text-center">
                        <ul class="pagination">
                            <li class="page-item">{{ $order->links() }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">
            <div class="relative overflow-x-auto sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Booking Code
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Room
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Person
                            </th>
                            <th scope="col" class="px-6 py-3">
                                date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Start time
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Start time
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appointment as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->order_id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->username }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->room }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->capacity }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->start_time }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->end_time }}
                                </td>
                            </tr>
                        @empty
                            <th colspan="6">
                                <div class="flex justify-center mt-10">
                                    <div class="max-w-xl bg-white rounded-2xl mb-10 drop-shadow-2xl dark:bg-gray-800 dark:border-gray-700">
                                        <img class="rounded-t-lg" src="/asset/notfound.png" alt="" />
                                        <div class="flex justify-center gap-2 p-5">
                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Pemesanan ruang meeting
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-blue-600 dark:text-white">
                                                    tidak ditemukan!
                                                </h5>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </th>
                        @endforelse
                    </tbody>
                </table>
            </div>            
        </div>
    </div>

    </div>
</div>
    
@endsection