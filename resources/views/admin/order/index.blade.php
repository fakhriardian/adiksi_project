@extends('layouts.dashboard')

@section('content')
<div class="mt-10 mb-10 container mx-auto">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
        <div class="flex flex-row mb-4 justify-between border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Website</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Cashier</button>
                </li>
                <li role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">History</button>
                </li>
            </ul>
            <form method="GET">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="search" name="search" id="search" value="{{ request('search') }}" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search with order id">
                </div>
            </form>
        </div>
        
        <div id="myTabContent">
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>     
                                <th scope="col" class="px-6 py-3">
                                    Order Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Timeline
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date
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
                                    @if ($item->paymentMethod == 'E-Payment' && $item->active == '0')       
                                        <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->order_id }}
                                        </th>
                                        @if ($item->timelines_id == '0')
                                            <td class="px-6 py-4">
                                                Menunggu konfirmasi
                                            </td>
                                        @else         
                                            <td class="px-6 py-4">
                                                {{ $item->timelines->name }}
                                            </td>
                                        @endif
                                        <td class="px-6 py-4">
                                            {{ $item->updated_at }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($item->status == 'unpaid')
                                                <div class="badge badge-error uppercase text-md">{{ $item->status }}</div>
                                            @else
                                                <div class="badge badge-accent uppercase text-md">{{ $item->status }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                                {{-- <a href="{{ route('invoice', $item->order_id) }}" target="_blank" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a> --}}
                                       
                                            <!-- Modal toggle -->
                                            <button data-modal-target="authentication-modal-{{ $item->order_id }}" data-modal-toggle="authentication-modal-{{ $item->order_id }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <i class="fa-solid fa-check" style="color: #ffffff;"></i>
                                                <span class="sr-only">Icon description</span>
                                            </button>
                                            
                                            <!-- Main modal -->
                                            <div id="authentication-modal-{{ $item->order_id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                                <div class="relative w-full h-full max-w-xl md:h-auto">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal-{{ $item->order_id }}">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="px-6 py-6 lg:px-8">
                                                            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Adiksi Coffee</h3>
                                                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                                <thead class="text-xs border-b border-t text-gray-900 uppercase dark:text-gray-400">
                                                                    <tr>
                                                                        <th colspan="4" class="px-6 py-3 text-center text-lg">
                                                                            Order id : {{ $item->order_id }}
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($carts as $cart)
                                                                        @if ($cart->order_id == $item->order_id)       
                                                                        
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
                                                                                <td class="px-6 py-1"> 
                                                                                    Rp {{ $cart->price }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot class="text-xs border-b border-t text-gray-900 dark:text-gray-400">
                                                                    <tr>
                                                                        <th colspan="3" class="px-6 py-3 uppercase">
                                                                            Total
                                                                        </th>
                                                                        <th colspan="1" class="px-6 py-3">
                                                                            @foreach ($order as $total)
                                                                                @if ($total->order_id == $item->order_id)       
                                                                                    Rp {{ $total->total }}
                                                                                @endif
                                                                            @endforeach
                                                                        </th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                            <form class="space-y-6 mt-4" method="POST" action="{{ route('timeline', $item->order_id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="flex items-end gap-5">
                                                                    <div class="flex flex-col">
                                                                        <label for="timeline" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Order timeline</label>
                                                                        <select id="timeline" name="timeline" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                            @if ($item->timelines_id == '0')
                                                                                <option selected>select</option>
                                                                                @foreach($timelines as $timeline)
                                                                                    <option value="{{ $timeline->value }}">{{ $timeline->name }}</option>
                                                                                @endforeach 
                                                                            @else                
                                                                                @foreach($timelines as $timeline)
                                                                                    <option value="{{ $timeline->value }}"
                                                                                            @if($item->timelines_id == ($timeline->id)) 
                                                                                                selected 
                                                                                            @endif>
                                                                                        {{ $timeline->name }}
                                                                                    </option>
                                                                                @endforeach 
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                    <input type="hidden" value="{{ $item->order_id }}">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 h-10 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                                        <i class="fa-solid fa-check" style="color: #ffffff;"></i>
                                                                        <span class="sr-only">Icon description</span>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                            <form class="space-y-6 mt-4" method="POST" action="{{ route('ePayment', $item->order_id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div>
                                                                    <label for="kasir" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">kasir</label>
                                                                    <select id="kasir" name="cashier" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                    @foreach ($workers as $worker)
                                                                        <option value="{{ $worker->name }}">{{ $worker->name }}</option>
                                                                    @endforeach
                                                                    </select>
                                                                </div>
                                                                @if ($item->timelines_id == '3')
                                                                    <button type="submit" class="w-40 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Selesai</button>
                                                                @else
                                                                    <button type="submit" disabled class="w-40 text-white bg-gray-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Selesai</button>
                                                                @endif
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <th colspan="5" class="px-2 py-3 text-center">
                                    Orderan masih kosong
                                </th>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- KASIR --}}
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>     
                                <th scope="col" class="px-6 py-3">
                                    Order Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Timeline
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date
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
                                    @if ($item->paymentMethod == 'Cash' && $item->active == '0')       
                                        <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->order_id }}
                                        </th>
                                        @if ($item->timelines_id == '0')
                                            <td class="px-6 py-4">
                                                Menunggu konfirmasi
                                            </td>
                                        @else         
                                            <td class="px-6 py-4">
                                                {{ $item->timelines->name }}
                                            </td>
                                        @endif
                                        <td class="px-6 py-4">
                                            {{ $item->updated_at }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($item->status == 'unpaid')
                                                <div class="badge badge-error uppercase text-md">{{ $item->status }}</div>
                                            @else
                                                <div class="badge badge-accent uppercase text-md">{{ $item->status }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <!-- Modal toggle -->
                                            <button data-modal-target="authentication-modal-{{ $item->order_id }}" data-modal-toggle="authentication-modal-{{ $item->order_id }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <i class="fa-solid fa-check" style="color: #ffffff;"></i>
                                                <span class="sr-only">Icon description</span>
                                            </button>
                                            
                                            <!-- Main modal -->
                                            <div id="authentication-modal-{{ $item->order_id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                                <div class="relative w-full h-full max-w-xl md:h-auto">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal-{{ $item->order_id }}">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="px-6 py-6 lg:px-8">
                                                            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Pesanan {{ $item->user_name }}</h3>
                                                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                                <thead class="text-xs border-b border-t text-gray-900 uppercase dark:text-gray-400">
                                                                    <tr>
                                                                        <th colspan="4" class="px-6 py-3 text-center text-lg">
                                                                            Order id : {{ $item->order_id }}
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($carts as $cart)
                                                                        @if ($cart->order_id == $item->order_id)       
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
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot class="text-xs border-b border-t text-gray-900 dark:text-gray-400">
                                                                    <tr>
                                                                        <th colspan="3" class="px-6 py-3 font-medium uppercase">
                                                                            Subtotal
                                                                        </th>
                                                                        <th colspan="1" class="px-6 font-medium text-right py-3">
                                                                            @foreach ($order as $total)
                                                                                @if ($total->order_id == $item->order_id)       
                                                                                    Rp {{ $total->total }}
                                                                                @endif
                                                                            @endforeach
                                                                        </th>
                                                                    </tr>
                                                                    <tr class="border-b">
                                                                        <th colspan="3" class="px-6 py-3 text-sm uppercase">
                                                                            Total
                                                                        </th>
                                                                        <th colspan="1" class="px-6 text-sm text-right py-3">
                                                                            @foreach ($order as $total)
                                                                                @if ($total->order_id == $item->order_id)       
                                                                                    Rp {{ $total->total }}
                                                                                @endif
                                                                            @endforeach
                                                                        </th>
                                                                    </tr>
                                                                    @if ($item->status == 'paid')
                                                                        <tr>
                                                                            <th colspan="3" class="px-6 py-1 text-right font-medium uppercase">
                                                                                Cash :
                                                                            </th>
                                                                            <th colspan="1" class="px-6 font-medium text-right py-1">
                                                                                @foreach ($order as $tunai)
                                                                                    @if ($tunai->order_id == $item->order_id)       
                                                                                        Rp {{ $tunai->tunai }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th colspan="3" class="px-6 py-1 text-right font-medium uppercase">
                                                                                Change :
                                                                            </th>
                                                                            <th colspan="1" class="px-6 py-1 font-medium text-right">
                                                                                @foreach ($order as $change)
                                                                                    @if ($change->order_id == $item->order_id)       
                                                                                        Rp {{ $change->change }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </th>
                                                                        </tr>
                                                                    @endif
                                                                </tfoot>
                                                            </table>
                                                             <form class="space-y-6 mt-4" method="POST" action="{{ route('timelineKasir', $item->order_id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                @if ($item->status == 'unpaid')
                                                                    <div class="flex justify-end gap-4 items-center">
                                                                        <label for="tunai" class="block text-md font-medium text-gray-900 dark:text-white">Cash</label>
                                                                        <div class="relative">
                                                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                                Rp
                                                                            </div>
                                                                            <input required name="tunai" type="number" id="num1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 pl-10 p-1  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                        </div>
                                                                    </div>
                                                                    @foreach ($order as $total)
                                                                        @if ($total->order_id == $item->order_id)       
                                                                            <input type="hidden" id="num2" value="{{ $total->total }}">
                                                                        @endif
                                                                    @endforeach
                                                                    <div class="flex justify-end gap-4 items-center">
                                                                        <label for="change" class="block text-md font-medium text-gray-900 dark:text-white">Change</label>
                                                                        <div class="relative">
                                                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                                Rp
                                                                            </div>
                                                                            <input readonly name="change" type="number" id="change" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 pl-10 p-1  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                        </div>
                                                                    </div>                                                                    
                                                                @endif
                                                                <div class="flex items-end gap-5">
                                                                    <div class="flex flex-col">
                                                                        <label for="timeline" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Order timeline</label>
                                                                        <select id="timeline" name="timeline" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                            @foreach($timelines as $timeline)
                                                                                <option value="{{ $timeline->value }}"
                                                                                        @if($item->timelines_id == ($timeline->id)) 
                                                                                            selected 
                                                                                        @endif>
                                                                                    {{ $timeline->name }}
                                                                                </option>
                                                                            @endforeach 
                                                                        </select>
                                                                    </div>
                                                                    <input type="hidden" value="{{ $item->order_id }}">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 h-10 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                                        <i class="fa-solid fa-check" style="color: #ffffff;"></i>
                                                                        <span class="sr-only">Icon description</span>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                            <form class="space-y-6 mt-4" method="POST" action="{{ route('cashPayment', $item->order_id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="flex items-center gap-4">
                                                                    <label for="kasir" class="block text-lg font-medium text-gray-900 dark:text-white">kasir</label>
                                                                    <select id="kasir" name="cashier" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-40 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                        @foreach ($workers as $worker)
                                                                            <option value="{{ $worker->name }}">{{ $worker->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @if ($item->timelines_id == '3')
                                                                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Selesai</button>
                                                                @else
                                                                    <button disabled type="submit" class="w-full text-white bg-gray-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Selesai</button>
                                                                @endif
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <th colspan="5" class="px-2 py-3 text-center">
                                    Orderan masih kosong
                                </th>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>     
                                <th scope="col" class="px-6 py-3">
                                    Order Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Cashier
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Payment Method
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
                                    @if ($item->active == '1')       
                                        <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->order_id }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $item->updated_at }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->cashier }}
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
                                        <td class="px-6 py-4">
                                            <!-- Modal toggle -->
                                            <a href="#" data-modal-target="authentication-modal-{{ $item->order_id }}" data-modal-toggle="authentication-modal-{{ $item->order_id }}" type="button" class="text-blue-800 font-bold">
                                                Details
                                            </a>
                                            <!-- Main modal -->
                                            <div id="authentication-modal-{{ $item->order_id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                                <div class="relative w-full h-full max-w-md md:h-auto">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal-{{ $item->order_id }}">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div id="printSection" class="px-6 py-6 lg:px-8">
                                                            <h3 class="mb-2 text-md font-medium text-gray-900 dark:text-white">Pesanan {{ $item->user_name }}</h3>
                                                            <div class="mb-2 flex justify-between">
                                                                <h3 class="text-md font-medium text-gray-900 dark:text-white">{{ $item->updated_at }}</h3>
                                                                <div class="badge badge-accent uppercase text-md">{{ $item->status }}</div>
                                                            </div>
                                                            <div class="flex mb-2">
                                                                @foreach ($order as $kasir)
                                                                    @if ($kasir->order_id == $item->order_id)
                                                                        <h3 class="mb-2 text-md font-medium text-gray-900 dark:text-white">
                                                                            Kasir : 
                                                                        </h3> {{ $kasir->cashier }}
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400">
                                                                <thead class="text-xs border-b border-t text-gray-900 uppercase dark:text-gray-400">
                                                                    <tr>
                                                                        <th colspan="4" class="px-6 py-3 text-center text-xs">
                                                                            Order id : {{ $item->order_id }}
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($carts as $cart)
                                                                        @if ($cart->order_id == $item->order_id)       
                                                                            <tr class="bg-white dark:bg-gray-800">
                                                                                <th scope="row" class="px-3 py-1 font-medium text-gray-900 dark:text-white">
                                                                                    {{ $cart->name }}
                                                                                </th>
                                                                                <td class="px-6 py-1">
                                                                                    {{ $cart->option }}
                                                                                </td>
                                                                                <td class="px-6 py-1">
                                                                                    {{ $cart->qty }}
                                                                                </td>
                                                                                <td class="px-6 py-1 whitespace-nowrap text-right"> 
                                                                                    Rp {{ $cart->price }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot class="text-xs border-t text-gray-900 dark:text-gray-400">
                                                                    <tr>
                                                                        <th colspan="3" class="px-3 py-2 font-medium">
                                                                            Subtotal
                                                                        </th>
                                                                        <th colspan="1" class="px-6 py-2 font-medium whitespace-nowrap text-right">
                                                                            @foreach ($order as $total)
                                                                                @if ($total->order_id == $item->order_id)       
                                                                                    Rp {{ $total->total }}
                                                                                @endif
                                                                            @endforeach
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th colspan="3" class="px-3 py-1 border-b text-lg uppercase">
                                                                            Total
                                                                        </th>
                                                                        <th colspan="1" class="px-6 py-1 border-b whitespace-nowrap text-lg text-right">
                                                                            @foreach ($order as $total)
                                                                                @if ($total->order_id == $item->order_id)       
                                                                                    Rp {{ $total->total }}
                                                                                @endif
                                                                            @endforeach
                                                                        </th>
                                                                    </tr>
                                                                    @if ($item->paymentMethod == 'Cash')     
                                                                        <tr>
                                                                            <th colspan="3" class="px-3 py-1">
                                                                                Cash
                                                                            </th>
                                                                            <th colspan="1" class="px-6 py-1 whitespace-nowrap text-right">
                                                                                @foreach ($order as $tunai)
                                                                                    @if ($tunai->order_id == $item->order_id)       
                                                                                        Rp {{ $tunai->tunai }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th colspan="3" class="px-3">
                                                                                Change
                                                                            </th>
                                                                            <th colspan="1" class="px-6 whitespace-nowrap text-right">
                                                                                @foreach ($order as $change)
                                                                                    @if ($change->order_id == $item->order_id)       
                                                                                        Rp {{ $change->change }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </th>
                                                                        </tr>
                                                                    @endif
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                        <button onclick="printSection()" type="button" class="ml-4 mb-4 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 h-8 my-auto dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                            Cetak
                                                        </button>
                                                    </div>
                                                </div>
                                            </div> 
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <th colspan="5" class="px-2 py-3 text-center">
                                    Orderan masih kosong
                                </th>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="flex md:flex-row flex-col gap-2 md:items-center justify-between pb-4">

        </div>
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
</div>
@endsection