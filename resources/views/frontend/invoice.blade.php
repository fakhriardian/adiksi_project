@extends('layouts.transaction')

@section('content')
<div class="flex flex-row justify-between shadow-lg px-5">
    <a href="/" class="flex items-center">
        <img src="/logo-images/adiksi_logo.png" class="-translate-y-0.5 h-10 mr-3 sm:h-12 hidden md:block"
            alt="Flowbite Logo" />
        <span id="alice"
            class="self-center leading-loose text-4xl font-serif font-semibold text-gold-800 whitespace-nowrap dark:text-white">adiksi</span>
    </a>
    <button onclick="printSection()" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 h-10 my-auto dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
        Cetak
    </button>
</div>

    <div class="container mt-5 mx-auto">
        <div id="printSection" class="w-full mx-auto max-w-2xl p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-row justify-between items-center bg-gold-800 p-5">
                <img src="/logo-images/adiksi_logo.png" class="-translate-y-0.5 h-10 mr-3 sm:h-12 hidden md:block"
                    alt="Flowbite Logo" />
                <h3 id="alice" class="uppercase font-bold text-xl">
                    adiksi coffee shop
                </h3>
            </div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <caption class="p-5 text-2xl font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        Invoice
                        @foreach ($orders as $order)
                            <div class="flex flex-row justify-between">
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    Order id :
                                </p>
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ $order->order_id }}
                                </p>
                            </div>
                            <div class="flex flex-row justify-between">
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    Date :
                                </p>
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ $order->updated_at }}
                                </p>
                            </div>
                            <p class="mt-1 text-sm font-normal text-right text-gray-500 capitalize dark:text-gray-400">
                                {{ $order->user_name }}
                            </p>
                            <p class="mt-1 text-sm font-normal text-left text-gray-500 capitalize dark:text-gray-400">
                                Table number : {{ $order->tableNumber }}
                            </p>
                        @endforeach
                    </caption>
                    <thead class="text-xs border-b border-t text-gray-900 uppercase dark:text-gray-400">
                        <tr>
                            <th colspan="4" class="px-6 py-3 text-center text-lg">
                                Dine In
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $cart->name }}
                                </th>
                                <td class="px-6 py-1">
                                    {{ $cart->option }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ $cart->qty }}
                                </td>
                                <td class="px-6 py-1 text-right"> 
                                    Rp {{ $cart->price }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="text-xs border-t text-gray-900 dark:text-gray-400">
                        <tr>
                            <th colspan="3" class="text-lg px-6 border-b py-3 uppercase">
                                Total
                            </th>
                            <th colspan="1" class="text-lg px-6 border-b py-3 text-right">
                                @foreach ($orders as $item)
                                    Rp {{ $item->total }}
                                @endforeach
                            </th>
                        </tr>
                        @foreach ($orders as $order)
                            @if ($order->paymentMethod == 'Cash')                      
                                <tr>
                                    <th colspan="3" class="px-6 py-2 uppercase">
                                        Tunai
                                    </th>
                                    <th colspan="1" class="px-6 py-2 text-right">
                                        @foreach ($orders as $item)
                                            Rp {{ $item->tunai }}
                                        @endforeach
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="px-6 py-2 uppercase">
                                        Kembalian
                                    </th>
                                    <th colspan="1" class="px-6 py-2 text-right">
                                        @foreach ($orders as $item)
                                            Rp {{ $item->change }}
                                        @endforeach
                                    </th>
                                </tr>
                            @endif
                        @endforeach
                    </tfoot>
                </table>
            </div>
            <hr class="mb-4">
            <div class="px-5 flex flex-col">
                @foreach ($orders as $item)
                    <div class="flex items-center">
                        <p class="text-md">
                            Status : 
                            <div class="badge badge-accent ml-2 uppercase text-xl">{{ $item->status }}</div>
                        </p>
                    </div>
                    <div class="flex">
                        <p class="text-md">
                            Metode pembayaran : {{ $item->paymentMethod }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection