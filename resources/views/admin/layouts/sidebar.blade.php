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
        <li>
            <a href="{{ url('admin/country') }}"
                class="sidenav-menu__link {{ request()->is('admin/country*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-flag"></i>
                    <span class="ms-2 fw-bold ">Country</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/coaching') }}"
                class="sidenav-menu__link {{ request()->is('admin/coaching*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span class="ms-2 fw-bold ">Coaching</span>
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
        <li>
            <a href="{{ url('admin/faq') }}"
                class="sidenav-menu__link {{ request()->is('admin/faq*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-question"></i>
                    <span class="ms-2 fw-bold">FAQ</span>

                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/terms-conditions') }}"
                class="sidenav-menu__link {{ request()->is('admin/terms-conditions*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-file-contract"></i>
                    <span class="ms-2 fw-bold">Terms Conditions</span>

                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/about-us') }}"
                class="sidenav-menu__link {{ request()->is('admin/about-us*') ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                  <i class="fa-solid fa-question"></i>
                    <span class="ms-2 fw-bold">About Us</span>

                </div>
            </a>
        </li>
    </div>
</div>



