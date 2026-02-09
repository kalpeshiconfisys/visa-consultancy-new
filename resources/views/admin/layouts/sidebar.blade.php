<style>

    .sidenav-menu__link::before,
    .sidenav-menu__link::after {
        display: none !important;
    }


    .sidenav-menu__link {
        border-left: none !important;
    }


    .sidenav-menu__link.active {
        background: linear-gradient(135deg, #3b4d3b);
        color: #fff !important;
        border-radius: 8px;
    }


    .sidenav-menu__link.active i,
    .sidenav-menu__link.active span {
        color: #fff !important;
    }

    .sidebar i {
        color: #637381
    }

    .sidebar span {
        color: #637381;
    }
</style>


<div class="sidebar ">
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
                  <i class="fa-solid fa-dashboard"></i>

                    <span class="ms-2 ">Dashboard</span>
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
                    <span class="ms-2  ">Visa Category</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/visa-sub-category') }}"
                class="sidenav-menu__link {{ request()->is('admin/visa-sub-category*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-list-check"></i>
                    <span class="ms-2   ">Visa Sub Category</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/blogs') }}"
                class="sidenav-menu__link {{ request()->is('admin/blogs*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-blog"></i>
                    <span class="ms-2  ">Blogs</span>
                </div>
            </a>
        </li>


        <li>
            <a href="{{ url('admin/coaching') }}" class="sidenav-menu__link {{ request()->is('admin/coaching*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span class="ms-2   ">Coaching</span>
                </div>
            </a>
        </li>
        <h4 class="h5">My Appointment</h4>
        <li>
            <a href="{{ url('admin/preferred-time') }}"
                class="sidenav-menu__link {{ request()->is('admin/preferred-time*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-stopwatch"></i>
                    <span class="ms-2   ">Appointment Time</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/consultation-method') }}"
                class="sidenav-menu__link {{ request()->is('admin/consultation-method*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-phone"></i>
                    <span class="ms-2  ">Consultation Method</span>
                </div>
            </a>
        </li>
        <h4 class="h5">Company Key Highlights</h4>
        <li>
            <a href="{{ url('admin/legal-assistance') }}"
                class="sidenav-menu__link {{ request()->is('admin/legal-assistance*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-award"></i>
                    <span class="ms-2   ">Legal Assistance</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/testimonials') }}"
                class="sidenav-menu__link {{ request()->is('admin/testimonials*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="ms-2   ">Testimonials</span>
                </div>
            </a>
        </li>
        <h4 class="h5">Company Settings</h4>
        <li>
            <a href="{{ url('admin/privacy-policy') }}"
                class="sidenav-menu__link {{ request()->is('admin/privacy-policy*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span class="ms-2   ">Privacy Policy</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/faq') }}"
                class="sidenav-menu__link {{ request()->is('admin/faq*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-question"></i>
                    <span class="ms-2  ">FAQ</span>

                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/terms-conditions') }}"
                class="sidenav-menu__link {{ request()->is('admin/terms-conditions*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-file-contract"></i>
                    <span class="ms-2 ">Terms Conditions</span>

                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/about-us') }}"
                class="sidenav-menu__link {{ request()->is('admin/about-us*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-user-group"></i>
                    <span class="ms-2  ">About Us</span>

                </div>
            </a>
        </li>
    </div>
</div>
