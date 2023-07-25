<nav class="px-12 bg-white drop-shadow-lg md:px-2 sm:px-4 py-2.5 dark:bg-gray-900 fixed w-full z-20 top-0 left-0 dark:border-gray-600">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <div class="container w-fit flex flex-wrap">
            <a href="/" class="flex items-center">
                <img src="/logo-images/adiksi_logo.png" class="-translate-y-0.5 h-10 mr-3 sm:h-12 hidden md:block"
                    alt="Flowbite Logo" />
                <span class="self-center font-alice leading-loose text-4xl text-gold-800 whitespace-nowrap dark:text-white">adiksi</span>
            </a>
        </div>
        <div class="flex">
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div class="items-center transition-transform justify-between hidden w-full md:flex md:w-auto md:order-1"
            id="navbar-sticky">
            <ul
                class="flex flex-col p-4 mt-4 border text-gray-700 border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-lg md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="/"
                        class="block py-2 pl-3 pr-4 transition duration-150 border-b-4 border-transparent hover:border-gold-800 hover:text-gold-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 @if(request()->is('/') || request()->is('/')) text-gold-800 @endif">beranda</a>
                </li>
                <li>
                    <a href="/pesan"
                        class="block py-2 pl-3 pr-4 transition duration-150 border-b-4 border-transparent hover:border-gold-800 hover:text-gold-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 @if(request()->is('/pesan') || request()->is('pesan')) text-gold-800 @endif">pesan</a>
                </li>
                <li>
                    <a href="/menu"
                        class="block py-2 pl-3 pr-4 transition duration-150 border-b-4 border-transparent hover:border-gold-800 hover:text-gold-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 @if(request()->is('/menu') || request()->is('menu')) text-gold-800 @endif">menu</a>
                </li>
                <li>
                    <a href="/lokasi-store"
                        class="block py-2 pl-3 pr-4 transition duration-150 border-b-4 border-transparent hover:border-gold-800 hover:text-gold-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 @if(request()->is('/lokasi-store') || request()->is('lokasi-store')) text-gold-800 @endif">lokasi
                        toko</a>
                </li>
                <li>
                    <a href="/hubungi-kami"
                        class="block py-2 pl-3 pr-4 transition duration-150 border-b-4 border-transparent hover:border-gold-800 hover:text-gold-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 @if(request()->is('/hubungi-kami') || request()->is('hubungi-kami')) text-gold-800 @endif">hubungi
                        kami</a>
                </li>
                <li>
                    @guest
                    <a href="/dashboard"
                        class="block py-2 pl-3 pr-4 transition duration-150 border-b-4 border-transparent hover:border-gold-800 hover:text-gold-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 @if(request()->is('/login') || request()->is('login')) text-gold-800 @endif">login
                    </a>
                    @else
                    <button id="dropdownNavbarButtonLogin" data-dropdown-toggle="dropdownNavbarLogin" class="flex items-center transition duration-150 justify-between w-full py-2 pl-3 pr-4 font-medium border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 hover:text-gold-800 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">{{ Auth()->user()->name }}<svg class="w-4 h-4 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbarLogin" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="md:w-48 w-full text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <a href="/riwayat-pemesanan" class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 hover:bg-gray-100 hover:text-gold-800 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                                <svg aria-hidden="true" class="w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path></svg>
                                Order History
                            </a>
                            <form method="post" action={{ route('logout') }}>
                                @csrf
                                <button type="submit" class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium rounded-b-lg hover:bg-gray-100 hover:text-gold-800 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                                    <i class="fa-solid fa-arrow-right-from-bracket px-0.5 mr-2"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    @endguest
                </li>
            </ul>
        </div>
    </div>
</nav>
