<div class="sidebar">
    <div class="sidenav__logo">
        <span class="sidebar-close" id="sidebarClose"
            style="display: none; font-size: 26px; cursor: pointer;">&times;</span>
    </div>
    <div class="sidenav-menu">
        @include('admin.layouts.navbar')
    </div>
    <div class="sidenav-menu">
        <h4 class="h5">Dashboard</h4>
        <li>
            <a href="{{ url('admin/dashboard') }}"
                class="sidenav-menu__link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span class="ms-2 fw-bold ">Dashboard</span>
                </div>
            </a>
        </li>
    </div>
    <div class="sidenav-menu">
        <h4 class="h5">My Content</h4>
        <li>
            <a href="{{ url('admin/visa-category') }}"
                class="sidenav-menu__link {{ request()->is('admin/visa-category*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-globe "></i>
                    <span class="ms-2 fw-bold ">Visa Category</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/visa-sub-category') }}"
                class="sidenav-menu__link {{ request()->is('admin/visa-sub-category*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-list-check"></i>
                    <span class="ms-2 fw-bold ">Visa Sub Category</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/blogs') }}"
                class="sidenav-menu__link {{ request()->is('admin/blogs*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-blog"></i>
                    <span class="ms-2 fw-bold ">Blogs</span>
                </div>
            </a>
        </li>
        <h4 class="h5">My Appointment</h4>
        <li>
            <a href="{{ url('admin/preferred-time') }}"
                class="sidenav-menu__link {{ request()->is('admin/preferred-time*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-stopwatch"></i>
                    <span class="ms-2 fw-bold ">Appointment Time</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/consultation-method') }}"
                class="sidenav-menu__link {{ request()->is('admin/consultation-method*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-phone"></i>
                    <span class="ms-2 fw-bold ">Consultation Method</span>
                </div>
            </a>
        </li>
        <h4 class="h5">Company Key Highlights</h4>
        <li>
            <a href="{{ url('admin/company-advantages') }}"
                class="sidenav-menu__link {{ request()->is('admin/company-advantages*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-award"></i>
                    <span class="ms-2 fw-bold ">Company Advantages</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/our-teams') }}"
                class="sidenav-menu__link {{ request()->is('admin/our-teams*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="ms-2 fw-bold ">Our Teams</span>
                </div>
            </a>
        </li>



        <h4 class="h5">Company Settings</h4>
        <li>
            <a href="{{ url('admin/privacy-policy') }}"
                class="sidenav-menu__link {{ request()->is('admin/privacy-policy*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span class="ms-2 fw-bold ">Privacy Policy</span>
                </div>
            </a>
        </li>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function openSubmenu(id) {
        $('.submenu-panel').removeClass('open close').hide();
        $(id).show().addClass('open');
    }

    function closeSubmenu(id) {
        $(id).removeClass('open').addClass('close');
        setTimeout(function() {
            $(id).hide().removeClass('close');
        }, 300); // matches animation duration
    }

    $(function() {
        // Handle People menu click
        $('#peopleMenu').on('click', function() {
            $('.submenu-panel').hide();
            $('#submenuPeople').show();
            $('.menu-item').removeClass('active');
            $(this).addClass('active');
        });

        // Handle Company menu click
        $('#companyMenu').on('click', function() {
            $('.submenu-panel').hide();
            $('#submenuCompany').show();
            $('.menu-item').removeClass('active');
            $(this).addClass('active');
        });

        // Close submenu when back arrow is clicked
        // $('#closePeople').on('click', function() {
        //     $('#submenuPeople').hide();
        //     $('.menu-item').removeClass('active');
        // });
        // $('#closeCompany').on('click', function() {
        //     $('#submenuCompany').hide();
        //     $('.menu-item').removeClass('active');
        // });
        $('#companyMenu').on('click', function() {
            openSubmenu('#submenuCompany');
            $('.menu-item').removeClass('active');
            $(this).addClass('active');
        });

        $('#closeCompany').on('click', function() {
            closeSubmenu('#submenuCompany');
            $('.menu-item').removeClass('active');
        });


        // Optional: handle other menu items
        $('#welcome, #dashboard, #myProfile').on('click', function() {
            $('.submenu-panel').hide();
            $('.menu-item').removeClass('active');
            $(this).addClass('active');
        });

        // Sidebar toggle for mobile
        $('#sidebarToggle').on('click', function() {
            $('.sidebar').toggleClass('open');
            $('body').toggleClass('sidebar-open');

        });
        // Optional: close sidebar when clicking overlay
        $(document).on('click', '.sidebar-overlay', function() {
            $('.sidebar').removeClass('open');
            $('body').removeClass('sidebar-open');
        });

        $('#sidebarClose').on('click', function() {
            $('.sidebar').removeClass('open');
            $('body').removeClass('sidebar-open');
            $('.sidebar-overlay').hide();
        });

        document.querySelectorAll('.sidenav-menu__link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.sidenav-menu__link').forEach(l => l.classList
                    .remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
