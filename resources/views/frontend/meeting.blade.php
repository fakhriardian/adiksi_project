@extends('layouts.authLayout')

@section('content')
<div class="absolute w-full h-screen blur-3xl bg-purple-50 overflow-hidden">
    <div class="absolute w-96 h-96 bg-gradient-to-r left-96 top-40 from-blue-900 to-indigo-400 rounded-full"></div>
    <div class="absolute w-96 h-96 bg-gradient-to-r right-96 top-56 from-blue-500 to-orange-400 rounded-full"></div>
</div>
<nav class="relative">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="inline-flex items-center justify-center w-fit px-5 group hover:shadow-xl bg-white border-white hover:bg-brokenwhite-200/50 backdrop-blur-sm rounded-lg transition-all duration-500 hover:scale-105 delay:75">
            <img src="/logo-images/adiksi_logo.png" class="-translate-y-0.5 w-6 h-6" alt="Adiksi Logo"/>
            <span class="self-center font-alice leading-loose text-2xl text-gray-400 group-hover:text-gold-800 whitespace-nowrap">adiksi</span>
        </a>
        <div class="flex items-center">
            <button type="button" data-dropdown-toggle="language-dropdown-menu" class="inline-flex bg-white border-white hover:bg-brokenwhite-200 group hover:shadow-xl hover:scale-105 items-center w-fit px-5 py-2 justify-center rounded-lg cursor-pointer transition-all duration-500">
                <div class="inline-flex items-center justify-center">
                    <i class="fa-solid fa-user text-md mr-2"></i>
                    <span class="text-xl text-gray-500 font-alice group-hover:text-gold-800 capitalize">
                        {{ Auth()->user()->name }}
                    </span>
                </div>
                <i class="fa-solid fa-angle-down text-xl text-gray-400 group-hover:text-black ml-2 duration-300 transition-all"></i>
            </button>
            <!-- Dropdown -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700" id="language-dropdown-menu">
                <ul class="font-medium" role="none">
                    <li>
                        <a href="/riwayat-pemesanan" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gold-800" role="menuitem">
                            <div class="inline-flex items-center">
                                <svg aria-hidden="true" class="w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path></svg>
                                Order History
                            </div>
                        </a>
                    </li>
                    <li>
                        <form method="post" action={{ route('logout') }}>
                            @csrf
                            <button type="submit" class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium rounded-b-lg hover:bg-gray-100 hover:text-gold-800 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                                <i class="fa-solid fa-arrow-right-from-bracket px-0.5 mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="relative flex flex-col font-mono justify-center items-center py-10 px-10 md:px-0">
    <h2 class="text-2xl md:text-4xl text-center text-black capitalize">
        discover spaces for meetings
    </h2>
    <p class="text-xs md:text-md text-center text-gray-500 mt-4 capitalize">
        No more wasting time lurking outside waiting for a meeting to end.
    </p>
</div>

<div class="relative container mx-auto rounded-2xl flex flex-col items-center backdrop-blur-sm bg-gray-50/70 md:max-w-4xl w-full h-60 py-4 px-6 mb-5">
    <form method="GET" class="container mx-auto max-w-4xl py-5">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative flex">
            <div class="absolute z-20 inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="date" name="date" value="{{ request('date') }}" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 rounded-l-lg backdrop-blur-sm bg-gray-50/70 border-none focus:ring-blue-500 focus:border-blue-500" placeholder="Search an available rooms">
            <div class="flex justify-center items-center bg-gray-50/70 backdrop-blur-xl rounded-r-lg px-2">
                <button type="submit" class="bg-blue-600/70 backdrop-blur-xl text-gray-50 rounded-lg px-3 py-1 transition-all duration-500 hover:bg-blue-600">search</button>
            </div>
        </div>
    </form>
    <div class="w-full flex flex-col items-center h-fit p-1 overflow-y-scroll">
        @forelse ($index as $item)      
            <ol class="relative text-gray-500 border-l-2 border-gray-600">                  
                <li class="mb-6 md:ml-20 ml-0">
                    <span class="absolute hidden md:flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -left-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    </span>
                    <div class="flex flex-col bg-white rounded-lg drop-shadow-xl md:w-96 w-72 p-2">
                        <div class="flex justify-between mb-2">
                            <h3 class="font-medium leading-tight">{{ $item->room }}</h3>
                            <p class="text-sm">{{ $item->date }}</p>
                        </div>
                        <div class="flex flex-row justify-between">
                            <div class="flex flex-col w-28">
                                <div class="inline-flex justify-between">
                                    <p class="text-sm">from</p>
                                    <p class="text-sm">: {{ $item->start_time }}</p>
                                </div>
                                <div class="inline-flex justify-between">
                                    <p class="text-sm">to</p>
                                    <p class="text-sm">: {{ $item->end_time }}</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                <span class="w-2 h-2 mr-1 bg-red-500 rounded-full"></span>
                                Unavailable
                            </span>
                        </div>
                    </div>
                </li>
            </ol>
        @empty
            <h3 class="font-medium leading-tight">Semua jadwal ruang meeting tersedia</h3>
        @endforelse
    </div>
</div>
<div class="flex justify-center">
    @if (session()->has('success'))
    <div id="alert-3" class="relative max-w-4xl flex p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
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
            class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8"
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
    @elseif (session()->has('error'))
    <div id="alert-2" class="relative md:max-w-4xl w-full flex p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Info</span>
        <div class="ml-3 text-sm font-medium">
            {{ session('error') }}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
    @endif
</div>

<div class="relative flex flex-col container mx-auto md:max-w-4xl w-full h-fit bg-white/60 backdrop-blur-2xl py-4 px-6 rounded-2xl">
    <div class="mb-4 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="meeting-tab" data-tabs-target="#meetingRoom" type="button" role="tab" aria-controls="meeting" aria-selected="false">Meeting Room</button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="booking-tab" data-tabs-target="#booking" type="button" role="tab" aria-controls="booking" aria-selected="false">Booking Meeting Room</button>
            </li>
            <li class="mr-2" role="presentation">
                <p id="clock" class="p-4 cursor-default absolute right-0"></p>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        <div class="hidden p-4 rounded-lg" id="meetingRoom" role="tabpanel" aria-labelledby="meeting-tab">
            <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-96 md:rounded-none md:rounded-l-lg" src="/store-image/meetingroom.png" alt="">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Meeting Room 1</h5>
                    <div class="inline-flex items-center gap-2">
                        <i class="fa-solid fa-users-rectangle text-3xl mb-2"></i>
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">8 orang</h5>
                    </div>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Ruang Meeting ini memiliki kapasitas sebesar 8 orang untuk setup Board. Sewa ruang meeting ini akan sangat memuaskan untuk anda karena ruangan ini memiliki desain yang unik dan nyaman, dengan nuansa nature dengan lantai yang terbuat dari kayu dan dihiasi dengan tanaman hijau yang semakin membuat suasana ruangan ini menjadi sangat nyaman dan juga santai dan akan membuat suasana acara anda menjadi semakin nyaman dan juga menyenangkan.</p>
                    <div class="py-2 mt-2 bg-gold-800 w-fit px-2 rounded-xl">               
                        <p class="text-black font-semibold text-xs capitalize">
                            rincian harga
                        </p>
                        <p class="text-black text-sm font-bold capitalize">
                            1 jam x Rp75.000
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden p-4 rounded-lg" id="booking" role="tabpanel" aria-labelledby="booking-tab">
            <form action="{{ route('appointment') }}" method="post">
                @csrf
                <div class="flex flex-col justify-center items-center md:flex-row py-5 gap-10">
                    <div class="bg-white w-60 h-fit rounded-lg px-3">
                        <label for="room_name" class="block text-xs text-gray-500 mt-2">Select an option</label>
                        <select id="room_name" name="room" class="text-gray-900 text-xl block w-full px-2.5 border-transparent focus:border-transparent focus:ring-0">
                            <option value="Meeting Room 1">meeting room 1</option>
                        </select>
                    </div>
                    <div class="bg-white w-56 h-fit rounded-lg px-3">
                        <div class="relative max-w-sm">
                            <label class="block text-xs text-gray-500 mt-2 capitalize">select date</label>
                            <input type="date" required name="date" min="{{ now()->toDateString() }}" value="{{ old('date') }}" class="text-gray-900 text-xl rounded-lg block w-full px-2.5 border-transparent focus:border-transparent focus:ring-0">
                        </div>
                    </div>
                    <div class="flex flex-row justify-between items-center gap-5 bg-white w-fit h-fit rounded-lg px-3">
                        <div class="relative w-fit">
                            <div class="inline-flex items-center">
                                <label class="block text-xs text-gray-500 mt-2 mr-1 capitalize">from time</label>
                                <button data-tooltip-target="tooltip-start" type="button" class="animate-pulse text-red-700 text-2xl">
                                    *
                                </button>
                                <div id="tooltip-start" role="tooltip" class="absolute z-10 w-56 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Booking dimulai dari jam 10:00 - 21:00
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                            <input type="time" id="time1" required name="start_time" step="3600" onchange="updateTime(this)" class="text-gray-900 text-xl rounded-lg block w-full px-2.5 border-transparent focus:border-transparent focus:ring-0">
                        </div>
                        <i class="text-xl translate-y-4 -translate-x-2 fa-solid fa-arrow-right"></i>
                        <div class="relative w-fit">
                            <div class="inline-flex items-center">
                                <label class="block text-xs text-gray-500 mt-2 mr-1 capitalize">to time</label>
                                <button data-tooltip-target="tooltip-to" type="button" class="animate-pulse text-red-700 text-2xl">
                                    *
                                </button>
                                <div id="tooltip-to" role="tooltip" class="absolute z-10 w-56 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Maksimal jam 22:00
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                            <input type="time" id="time2" required name="end_time" step="3600" onchange="updateTime(this)" class="text-gray-900 text-xl rounded-lg block w-full px-2.5 border-transparent focus:border-transparent focus:ring-0">
                        </div>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="inline-flex px-3 py-2 bg-white mr-2 text-lg shadow-xl rounded-lg">
                        <div>
                            Rp 75.000
                        </div>
                        <div class="px-2">
                            x
                        </div>
                        <div id="result">
                            0
                        </div>
                    </div>
                    <div class="inline-flex items-center justify-around">
                        <div class="inline-flex px-3 py-2 bg-white mr-2 text-lg shadow-xl rounded-lg">
                            <div class="flex items-center gap-1 text-gray-900">
                                <input type="number" name="capacity" required id="small-input" class="block w-10 p-2 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
                                <label for="small-input" class="block text-md text-gray-900 dark:text-white">Orang</label>
                            </div>
                        </div>
                        <div class="inline-flex px-3 py-2 text-lg bg-white shadow-xl rounded-l-lg">
                            <div class="px-1">
                                Rp
                            </div>
                            <div id="totalPrice" class="px-1">
                                0
                            </div>
                        </div>
                        <input type="hidden" name="duration" id="duration">
                        <input type="hidden" name="total" id="total">
                        <button type="submit" id="pay-button" class="px-3 py-2 backdrop-blur-xl rounded-r-xl shadow-xl bg-black/50 text-xl text-white transition-all duration-500 hover:rounded-xl hover:scale-105 hover:shadow-xl capitalize hover:bg-black">book now</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<script>
    function performSubtraction() {
      var time1Input = document.getElementById('time1').value;
      var time2Input = document.getElementById('time2').value;

      var time1 = time1Input.split(':');
      var time2 = time2Input.split(':');

      var hours1 = parseInt(time1[0]);
      var minutes1 = parseInt(time1[1] || 0); // Default to 0 if seconds component is missing
      var seconds1 = parseInt(time1[2] || 0); // Default to 0 if seconds component is missing

      var hours2 = parseInt(time2[0]);
      var minutes2 = parseInt(time2[1] || 0); // Default to 0 if seconds component is missing
      var seconds2 = parseInt(time2[2] || 0); // Default to 0 if seconds component is missing

      var totalSeconds1 = (hours1 * 3600) + (minutes1 * 60) + seconds1;
      var totalSeconds2 = (hours2 * 3600) + (minutes2 * 60) + seconds2;

      var diffSeconds = totalSeconds2 - totalSeconds1;
      var diffHours = Math.floor(diffSeconds / 3600);

      var price = diffHours * 75000;

      document.getElementById('result').textContent = diffHours;
      document.getElementById('duration').value = diffHours;
      document.getElementById('totalPrice').textContent = price;
      document.getElementById('total').value = price;
    }
    document.getElementById('time2').addEventListener('input', performSubtraction);
</script>
<script>
    function updateTime(input) {
        var selectedTime = input.value.split(":");
        var hour = selectedTime[0];

        // Set the selected time with the minutes component always set to 00
        input.value = hour + ":00";
    }
    // Listen for changes in the second time input
    $('#time1').on('input', function() {
        var time2Value = $(this).val();

        // Set the minimum value for the first time input
        $('#time2').attr('min', time2Value);
    });
</script>
<script>
    function updateClock() {
      var currentTime = new Date();
      var formattedTime = currentTime.toLocaleTimeString();
      document.getElementById("clock").textContent = formattedTime;
    }
    
    // Update the clock immediately
    updateClock();
    
    // Update the clock every second (1000 milliseconds)
    setInterval(updateClock, 1000);
</script>