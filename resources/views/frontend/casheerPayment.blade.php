@extends('layouts.transaction')

@section('content')

<div class="h-screen w-screen flex items-center justify-center">
    <div class="w-lg flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <img class="rounded-t-lg max-w-sm" src="/asset/order_processed.png" alt="" />
        <div class="p-5 text-center">
            @foreach ($orders as $item)   
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Halo {{ $item->user_name }}, your order is on process</h5>
                <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">Silahkan menuju kasir dan menunjukan order id untuk menyelesaikan pembayaran.</p>
                <h5 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Order id : {{ $item->order_id }}</h5>
            @endforeach
            <a href="/riwayat-pemesanan" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Selesai
                <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
        </div>
    </div>
</div>
@endsection