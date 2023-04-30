@extends('layouts.frontend')

@section('content')
    <div class="md:mt-28 mt-24 container mx-auto">
        <div class="flex flex-col md:p-0 p-5">
            <div class="flex">
                <h4 id="poppins" class="text-black text-xl mr-2">Menu</h4>
                <h4 id="poppins" class="text-gray-500 text-xl">Category</h4>
            </div>

            <div class="flex">
                <div class="relative gap-5 carousel carousel-center md:w-10/12 w-8/12 h-32 rounded-box place-items-center">
                    @foreach ($categories as $category)
                        <a href="{{ route('items.category', ['categories[]' => $category->id]) }}"
                            class="{{ in_array($category->id, $selectedCategories) }} mr-2 ml-2 translate-y-5 rounded-b-[36px] text-center bg-gray-50 hover:translate-y-2 hover:scale-110 hover:rounded-t-xl shadow-md transition-all duration-300 hover:shadow-darkblue-800 hover:bg-darkblue-800 md:px-6 px-3 lg:h-[8vh] h-14 text-black hover:text-white justify-center delay-50ms] taos:[transform:translate3d(200px,0,0)_scale(0.6)] taos:opacity-0"
                            data-taos-offset="50">
                            <div
                                class="flex rounded-xl mx-auto bg-white -translate-y-9 w-14 md:h-14 h-10 justify-center items-center shadow-md text-black hover:text-darkblue-800">
                                <div class="md:text-xl text-lg">
                                    @php
                                        echo $category->icon;
                                    @endphp
                                </div>
                            </div>
                            <div class="absolute flex w-14 h-10 -z-10 justify-center -translate-y-10 items-center ">
                                <h6 id="poppins" class="text-xs mt-1">
                                    {{ $category->name }}
                                </h6>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="border-r-4 border-darkblue-800 mx-auto"></div>
                <!-- drawer init and toggle -->
                <button
                    class="my-auto mx-auto rounded-xl bg-white hover:bg-darkblue-800 text-black hover:text-white hover:-translate-y-2 shadow-md md:w-fit w-14 md:h-fit h-14 md:p-5 p-2 transition-all duration-300"
                    type="button" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example"
                    data-drawer-placement="right" aria-controls="drawer-right-example"">
                    <div class="relative flex flex-col justify-center items-center">
                        <span
                            class="totalProduct absolute flex w-7 h-7 bg-red-500 rounded-full justify-center items-center text-xs text-white -translate-y-7 translate-x-7">
                            {{ count($carts) }}
                        </span>
                        <i class="fa-solid fa-basket-shopping md:text-3xl text-2xl"></i>
                    </div>
                </button>

                <!-- drawer component -->
                <div id="drawer-right-example"
                    class="fixed top-0 right-0 z-40 ease-in-out duration-500 transition h-screen p-4 overflow-y-auto translate-x-full bg-white w-80 dark:bg-gray-800"
                    tabindex="-1" aria-labelledby="drawer-right-label">
                    <h5 id="drawer-right-label"
                        class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">My
                        Cart</h5>
                    <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close menu</span>
                    </button>
                    <div class="mt-2 mb-48">
                        <div class="flow-root">
                            <ul role="list" class="-my-6 divide-y divide-gray-200">
                                @forelse ($carts as $cart)
                                    <li class="flex py-6 data-cart-list">
                                        <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                            <img src={{ asset('store-image/' . $cart->image)}} alt="" class="h-full w-full object-cover object-center">
                                        </div>
                                        <div class="ml-4 flex flex-1 flex-col">
                                            <div>
                                                <div class="flex justify-between text-base font-medium text-gray-900">
                                                    <h3>
                                                        <div>{{ $cart->name }}</div>
                                                    </h3>
                                                    <p class="ml-4">Rp{{ $cart->price }}</p>
                                                </div>
                                                <p class="mt-1 text-sm text-gray-500">{{ $cart->qty }}</p>
                                                <p class="mt-1 text-sm text-gray-500">{{ $cart->option }}</p>
                                            </div>
                                            <div class="flex flex-1 items-end justify-between text-sm">
                                                <p class="cart-item text-gray-500"></p>
                                                <div class="flex">
                                                    <form action="{{ route('order.destroy', $cart->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                        class="delete font-medium text-indigo-600 hover:text-indigo-500">
                                                        Remove</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <div class="max-w-xl bg-white rounded-2xl mb-10 drop-shadow-2xl dark:bg-gray-800 dark:border-gray-700 mt-10">
                                        <img class="rounded-t-lg" src="/asset/empty-cart.png" alt="" />
                                        <div class="flex justify-center p-5">
                                            <h5 class="mb-2 text-md text-center font-bold tracking-tight text-gray-900 dark:text-white">
                                                Keranjangmu masih kosong.
                                            </h5>
                                        </div>
                                    </div>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <form method="post" action={{ route('checkout') }}>
                    @csrf
                        <div class="border-t border-gray-200 py-2 fixed bottom-0 px-10">
                            @foreach ($carts as $item)
                                <input type="hidden" value="{{ $item->name }}" name="name-{{ $item->id }}" id="">
                                <input type="hidden" value="{{ $item->price }}" name="price-{{ $item->id }}" id="">
                                <input type="hidden" value="{{ $item->qty }}" name="qty-{{ $item->id }}" id="">
                                <input type="hidden" value="{{ $item->option }}" name="option-{{ $item->id }}" id="">
                            @endforeach
                            <div class="flex justify-between text-sm font-medium text-gray-900">
                                <p>Subtotal</p>
                                <p>Rp {{ $total }}</p>
                                <input type="hidden" value={{ $total }} name="subtotal">
                            </div>
                            <hr class="mt-2 mb-2">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <p>Total</p>
                                <p>Rp {{ $total }}</p>
                                <input type="hidden" value={{ $total }} name="total">
                            </div>
                            <div class="flex justify-between mt-2 font-medium items-center text-gray-900">
                                <label for="small-input" class="block text-md font-medium text-gray-900 dark:text-white">No meja</label>
                                <input type="number" placeholder="10" name="tableNumber" required id="small-input" class="block w-10 p-2 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <p class="mt-0.5 text-xs text-gray-500">Taxes already includes with item price.</p>
                            <div class="mt-4">
                                @if (count($carts) < 1)
                                    <button type="submit" disabled class="w-full cursor-not-allowed text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">checkout</button>
                                @else             
                                    <button type="submit" class="w-full text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">checkout</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- MENU LIST --}}
        <div class="flex flex-col md:mt-10 mt-0 md:p-0 p-5">
            <div class="flex mb-5">
                <h4 id="poppins" class="text-black text-xl mr-2">Menu</h4>
                <h4 id="poppins" class="text-gray-500 text-xl">List</h4>
            </div>
            <form method="GET">
                <div class="w-full gap-2 flex justify-between md:px-0 px-5 mb-10">              
                    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative md:w-1/3 w-full drop-shadow-lg">
                        <input type="search" name="search" id="search" value="{{ request('search') }}" class="block w-full p-4 pl-5 text-sm text-gray-900 border-none rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
                        <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-darkblue-800 hover:bg-gold-800 transition-all duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg aria-hidden="true" class="w-5 h-5 text-white dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </div>
    
                    <!-- Modal toggle -->
                    @if (count($countDraft) == 0)
                        <div class="relative flex flex-col justify-center items-center">
                            <button data-modal-target="defaultModal-soldOut" disabled data-modal-toggle="defaultModal-soldOut" class="relative block text-white drop-shadow-xl shadow hover:bg-gold-800 cursor-not-allowed bg-darkblue-800 transition-all duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg md:text-sm text-xs px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                <span
                                    class="totalProduct absolute z-10 flex w-7 h-7 bg-red-500 rounded-full justify-center items-center text-xs text-white -translate-y-5 md:translate-x-[16vh] translate-x-16">
                                    {{ count($countDraft) }}
                                </span>
                                Sold Out Menu !
                            </button>
                        </div>
                    @else
                        <div class="relative flex flex-col justify-center items-center">
                            <button data-modal-target="defaultModal-soldOut" data-modal-toggle="defaultModal-soldOut" class="relative block text-white drop-shadow-xl shadow hover:bg-gold-800 bg-darkblue-800 transition-all duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg md:text-sm text-xs px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                <span
                                    class="totalProduct absolute z-10 flex w-7 h-7 bg-red-500 rounded-full justify-center items-center text-xs text-white -translate-y-5 md:translate-x-[16vh] translate-x-16">
                                    {{ count($countDraft) }}
                                </span>
                                Sold Out Menu !
                            </button>
                        </div>
                    @endif
                </div>
            </form>
            <!-- Main modal -->
            <div id="defaultModal-soldOut" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl translate-y-1 font-semibold text-gray-900 dark:text-white">
                                Sorry, some menu are sold out.
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal-soldOut">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 flex flex-wrap gap-4 justify-center">
                            @foreach ($draft as $sold)        
                                <div class="card w-40 bg-base-100 shadow-xl hover:-translate-y-3 hover:scale-100 transition ease-in-out duration-500 hover:text-white hover:bg-gold-800"
                                    data-taos-offset="0">
                                <img src="{{ asset('store-image/' . $sold->image) }}" alt="Image-item"
                                    class="item-image mx-auto w-20 rounded-xl drop-shadow-2xl object-cover" />
                                <div class="card-body">
                                    <h2 class="item-name card-title md:h-12 h-12 md:text-xl text-lg">{{ $sold->name }}</h2>
                                    <div class="flex justify-between">
                                        <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Sold Out</span>
                                    </div>
                                </div>
                            </div>    
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>  
            <div class="flex flex-wrap justify-center gap-4">
                @forelse ($items as $item)
                    <form method="post" action={{ route('addtocart') }}>
                        @csrf
                        <div class="item">
                            <div class="card md:w-60 w-40 bg-base-100 shadow-xl hover:-translate-y-3 hover:scale-100 transition ease-in-out duration-500 hover:text-white hover:bg-gold-800 taos:[transform:translate3d(0,200px,0)_scale(0.6)] taos:opacity-0" data-taos-offset="0">
                                <figure class="w-full md:h-56 h-40">
                                    <img src="{{ asset('store-image/' . $item->image) }}" alt="Image-item"
                                        class="item-image max-w-sm rounded-xl drop-shadow-2xl object-cover hover:scale-110 hover:rotate-12 transition ease-in-out duration-500" />
                                </figure>
                                <div class="card-body">
                                    <h2 class="item-name card-title md:h-12 h-12 md:text-xl text-lg">{{ $item->name }}</h2>
                                    <div class="flex justify-between">
                                        <p class="my-auto font-normal md:text-lg text-xs md:mr-0 mr-2 dark:text-gray-400">
                                            Rp {{ $item->price }}
                                        </p>
                                        <button type="button" data-modal-target="modal-{{ $item->id }}"
                                            data-modal-toggle="modal-{{ $item->id }}"
                                            class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm md:px-5 px-2.5 md:py-2.5 py-1 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Main modal -->
                            <div id="modal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                <div class="relative w-full h-full md:max-w-2xl max-w-md md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative p-6 bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                            data-modal-hide="modal-{{ $item->id }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <!-- Modal header -->
                                        <div class="px-6 py-4 border-b rounded-t dark:border-gray-600 mb-6">
                                            <h3 class="text-base font-semibold text-gray-900 lg:text-xl dark:text-white">
                                                Tambahkan menu
                                            </h3>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="flex flex-col justify-between bg-white md:flex-row md:max-w-xl">
                                            <img id="item-image-{{ $item->id }}"
                                                class="max-w-md mx-auto rounded-t-lg md:h-48 md:rounded-none md:rounded-l-lg"
                                                src="{{ asset('store-image/' . $item->image) }}" alt={{ $item->image }}>
                                                <input type="hidden" value={{ $item->image }} name="item-image">
                                            <div class="flex flex-col justify-between p-4 leading-normal">
                                                <h5 id="item-name-{{ $item->id }}"
                                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                    {{ $item->name }}</h5>
                                                    <div class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                                        @php
                                                            echo $item->desc;
                                                        @endphp
                                                    </div>
                                                <input type="hidden" value="{{ $item->name }}" name="item-name">
                                                <div class="flex justify-between mt-5">
                                                    <span class="text-xl flex items-center font-bold">Rp
                                                        <h5 id="item-price-{{ $item->id }}"
                                                            class="price flex-inline text-xl my-auto ml-1 mr-6 font-bold tracking-tight text-gray-900 dark:text-white">
                                                            {{ $item->price }}
                                                        </h5>
                                                        <input type="hidden" value={{ $item->price }} name="item-price">
                                                    </span>
                                                    <button type="button"
                                                        class="minus text-white hover:text-black transition-all duration-300 bg-darkblue-800 hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
                                                        -
                                                    </button>
                                                    <span
                                                        class="counter text-center my-auto mr-2 ml-2 text-gray-900 text-lg block w-12 border-transparent focus:border-transparent focus:ring-0">
                                                        1
                                                    </span>
                                                    <input type="hidden" class="counterQty-{{ $item->id }}" name="item-qty" value="1">
                                                    <button type="button"
                                                        class="plus text-white hover:text-black transition-all duration-300 bg-darkblue-800 hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
                                                        +
                                                    </button>
                                                </div>
                                                <span id="itemPerProduct-{{ $item->id }}"
                                                    class="itemPerProduct text-center my-auto mr-2 ml-2 text-gray-900 text-lg block w-12 border-transparent focus:border-transparent focus:ring-0 sr-only">
                                                    0
                                                </span>
                                            </div>
                                        </div>
                                        @if ($item->categories_id == 7)
                                            <input type="hidden" checked id="bordered-radio-4" type="radio" value="Normal" name="option" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        @elseif ($item->categories_id == 6)
                                            <input type="hidden" checked id="bordered-radio-4" type="radio" value="Normal" name="option" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        @else
                                            <div class="flex flex-row mt-10">
                                                <div class="w-full flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                                    <input required id="bordered-radio-4" type="radio" value="Hot" name="option" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="bordered-radio-4" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hot</label>
                                                </div>
                                                <div class="w-full flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                                    <input required id="bordered-radio-5" type="radio" value="Normal Ice" name="option" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="bordered-radio-5" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Normal Ice</label>
                                                </div>
                                                <div class="w-full flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                                    <input required id="bordered-radio-6" type="radio" value="Less Ice" name="option" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="bordered-radio-6" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Less Ice</label>
                                                </div>
                                            </div>                                      
                                        @endif
                                        <div class="flex flex-col justify-center items-center">
                                            <button type="submit"
                                                class="add-to-cart-btn inline-flex mt-10 text-white justify-center hover:text-darkblue-800 bg-darkblue-800 hover:bg-gray-100 focus:ring-4 transition-all duration-300 focus:ring-blue-300 font-medium rounded-lg text-sm md:px-10 w-full py-2.5 mb-2">add
                                                to cart -
                                                <h3 class="total inline-flex w-fit h-4 ml-1 text-sm font-semibold">
                                                    Rp {{ $item->price }}
                                                </h3>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @empty
                    <div class="max-w-xl bg-white rounded-2xl mb-10 drop-shadow-2xl dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg" src="/asset/notfound.png" alt="" />
                        </a>
                        <div class="flex justify-center gap-2 p-5">
                            <h5 class="mb-2 md:text-2xl text-sm font-bold tracking-tight text-gray-900 dark:text-white">Maaf, menu yang kamu cari
                                <h5 class="mb-2 md:text-2xl text-sm font-bold tracking-tight text-blue-600 dark:text-white">
                                    tidak ditemukan!
                                </h5>
                            </h5>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
