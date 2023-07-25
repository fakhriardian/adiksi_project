<nav class="main-header navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        {{-- Left sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        {{-- Custom left links --}}
        @yield('content_top_nav_left')
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">
        {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-bell"></i>
              <span id="unreadNotificationsCount" class="badge badge-danger"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationsDropdown" id="notificationsDropdownMenu">
              <a class="dropdown-item" href="#">Loading...</a>
            </div>
          </li> --}}
          
        {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell"></i>
                <span class="badge badge-warning navbar-badge">5</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Notifications</span>
                <div class="dropdown-divider"></div>
                <!-- Notification Items -->
                <a href="#" class="dropdown-item">
                    <!-- Notification Content -->
                </a>
                <!-- Add more notification items as needed -->
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">View All Notifications</a>
            </div>
        </li> --}}
        
        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        {{-- Configured right links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        {{-- User menu link --}}
        @if(Auth::user())
            @if(config('adminlte.usermenu_enabled'))
                @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
            @else
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @endif
        @endif

        {{-- Right sidebar toggler link --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>

</nav>
<script>
    function updateNotifications() {
        $.ajax({
            url: '/notifications',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
            var notificationsDropdownMenu = $('#notificationsDropdownMenu');
            var unreadNotificationsCount = $('#unreadNotificationsCount');

            notificationsDropdownMenu.empty();

            if (response.length > 0) {
                response.forEach(function (notification) {
                notificationsDropdownMenu.append('<a class="dropdown-item" href="#">' + notification.message + '</a>');
                });
            } else {
                notificationsDropdownMenu.append('<a class="dropdown-item" href="#">No new notifications</a>');
            }

            unreadNotificationsCount.text(response.length);
            }
        });
        }

        // Call the function on page load
        updateNotifications();

        // Set interval to periodically update notifications (e.g., every 10 seconds)
        setInterval(updateNotifications, 10000);

</script>