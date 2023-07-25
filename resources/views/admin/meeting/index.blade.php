@extends('layouts.dashboard')

@section('content')
<div class="p-8">
    <h2 class="text-4xl mb-6 font-extrabold dark:text-white">Booking List Room Meeting</h2>

    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="active-tab" data-tabs-target="#active" type="button" role="tab" aria-controls="active" aria-selected="false">Booking List</button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="history-tab" data-tabs-target="#history" type="button" role="tab" aria-controls="history" aria-selected="false">History</button>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="active" role="tabpanel" aria-labelledby="active-tab">            
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
                                Room
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Time
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
                                    {{ $item->order_id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->user_email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->username }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->room }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->start_time }} -
                                    {{ $item->end_time }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button type="button" data-modal-target="authentication-modal-{{ $item->id }}" data-modal-toggle="authentication-modal-{{ $item->id }}"
                                        class="text-darkblue-800 bg-transparent text-center hover:bg-darkblue-800 hover:text-white transition-all duration-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        Show
                                    </button>
                                    <div id="authentication-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                        <div class="relative w-full h-full md:max-w-2xl md:h-auto">
                                            <!-- Modal content -->
                                            <div class="bg-white border border-gray-200 rounded-lg shadow">
                                                <div class="p-5">
                                                    <form action="{{ route('booking.update', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <h2 class="text-2xl text-black font-bold">Booking Edit</h2>
                                                        <div class="flex flex-col py-3">
                                                            <p class="text-lg text-left text-black">
                                                                Email : {{ $item->user_email }}
                                                            </p>
                                                            <p class="text-lg text-left text-black">
                                                                Username : {{ $item->username }}
                                                            </p>
                                                        </div>
                                                        <div class="flex bg-white drop-shadow-xl py-3">
                                                            <div class="bg-white w-60 h-fit rounded-lg px-3">
                                                                <label for="room_name" class="block text-xs text-gray-500 mt-2">Select an option</label>
                                                                <select id="room_name" name="room" class="text-gray-900 text-xl block w-full px-2.5 border-transparent focus:border-transparent focus:ring-0">
                                                                    <option value="Meeting Room 1">meeting room 1</option>
                                                                </select>
                                                            </div>
                                                            <div class="bg-white w-56 h-fit rounded-lg px-3">
                                                                <div class="relative max-w-sm">
                                                                    <label class="block text-xs text-gray-500 mt-2 capitalize">select date</label>
                                                                    <input type="date" required name="date" min="{{ now()->toDateString() }}" value="{{ $item->date }}" class="text-gray-900 text-xl rounded-lg block w-full px-2.5 border-transparent focus:border-transparent focus:ring-0">
                                                                </div>
                                                            </div>
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
                                                                <input type="time" required name="start_time" min="10:00" max="21:00" step="3600" value="{{ $item->start_time }}" onchange="updateTime(this)" class="text-gray-900 text-xl rounded-lg block w-full px-2.5 border-transparent focus:border-transparent focus:ring-0">
                                                            </div>
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
                                                                <input type="time" required name="end_time" min="11:00" max="22:00" step="3600" value="{{ $item->end_time }}" onchange="updateTime(this)" class="text-gray-900 text-xl rounded-lg block w-full px-2.5 border-transparent focus:border-transparent focus:ring-0">
                                                            </div>
                                                        </div>
                                                        <div class="inline-flex items-center gap-5">
                                                            <button class="px-3 py-3 bg-gray-500 rounded-xl mt-4 text-white">Update</button>
                                                            <a href="{{ route('done', $item->id) }}" onclick="return confirm('Selesai?')"
                                                                class="px-3 py-3 bg-gray-500 rounded-xl mt-4 text-white">
                                                                Done
                                                            </a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Kosong.
                                </th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="history" role="tabpanel" aria-labelledby="history-tab">            
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
                                Room
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Time
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($history as $item)               
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row" class="px-3 text-center py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->order_id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->user_email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->username }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->room }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->start_time }} -
                                    {{ $item->end_time }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button type="button" data-modal-target="authentication-modal-{{ $item->id }}" data-modal-toggle="authentication-modal-{{ $item->id }}"
                                        class="text-darkblue-800 bg-transparent text-center hover:bg-darkblue-800 hover:text-white transition-all duration-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        Show
                                    </button>
                                    <div id="authentication-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                        <div class="relative w-full h-full md:max-w-2xl md:h-auto">
                                            <!-- Modal content -->
                                            <div class="bg-white border border-gray-200 rounded-lg shadow">
                                                <div class="p-5">
                                                    <form action="{{ route('booking.update', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <h2 class="text-2xl text-black font-bold">Booking Edit</h2>
                                                        <div class="flex flex-col py-3">
                                                            <p class="text-lg text-left text-black">
                                                                Email : {{ $item->user_email }}
                                                            </p>
                                                            <p class="text-lg text-left text-black">
                                                                Username : {{ $item->username }}
                                                            </p>
                                                        </div>
                                                        <div class="flex bg-white drop-shadow-xl py-3">
                                                            <div class="bg-white w-60 h-fit rounded-lg px-3">
                                                                <label for="room_name" class="block text-xs text-gray-500 mt-2">Select an option</label>
                                                                <select id="room_name" name="room" class="text-gray-900 text-xl block w-full px-2.5 border-transparent focus:border-transparent focus:ring-0">
                                                                    <option value="Meeting Room 1">meeting room 1</option>
                                                                </select>
                                                            </div>
                                                            <div class="bg-white w-56 h-fit rounded-lg px-3">
                                                                <div class="relative max-w-sm">
                                                                    <label class="block text-xs text-gray-500 mt-2 capitalize">select date</label>
                                                                    <input type="date" required name="date" min="{{ now()->toDateString() }}" value="{{ $item->date }}" class="text-gray-900 text-xl rounded-lg block w-full px-2.5 border-transparent focus:border-transparent focus:ring-0">
                                                                </div>
                                                            </div>
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
                                                                <input type="time" required name="start_time" min="10:00" max="21:00" step="3600" value="{{ $item->start_time }}" onchange="updateTime(this)" class="text-gray-900 text-xl rounded-lg block w-full px-2.5 border-transparent focus:border-transparent focus:ring-0">
                                                            </div>
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
                                                                <input type="time" required name="end_time" min="11:00" max="22:00" step="3600" value="{{ $item->end_time }}" onchange="updateTime(this)" class="text-gray-900 text-xl rounded-lg block w-full px-2.5 border-transparent focus:border-transparent focus:ring-0">
                                                            </div>
                                                        </div>
                                                        <div class="inline-flex items-center gap-5">
                                                            <button class="px-3 py-3 bg-gray-500 rounded-xl mt-4 text-white">Update</button>
                                                            <a href="{{ route('done', $item->id) }}" onclick="return confirm('Selesai?')"
                                                                class="px-3 py-3 bg-gray-500 rounded-xl mt-4 text-white">
                                                                Done
                                                            </a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Kosong.
                                </th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
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
