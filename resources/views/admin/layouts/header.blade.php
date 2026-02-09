<style>

    .avatar-wrapper {
        position: relative;
    }

    .avatar:hover {
        transform: scale(1.08);
        box-shadow: 0 12px 30px rgba(0, 0, 0, .35);
    }

    .dropdown {
        position: absolute;
        right: 0;
        margin-top: 12px;
        min-width: 190px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(12px);
        border-radius: 10px;
        box-shadow: 0 25px 45px rgba(0, 0, 0, .25);
        padding: 10px;
        display: none;
        flex-direction: column;
        animation: fade .25s ease;
    }

    @keyframes fade {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown a {
        text-decoration: none;
        color: #333;
        padding: 8px 10px;
        border-radius: 7px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: .2s ease;
    }

    .dropdown a:hover {
        background: #eef1ff;
        color: #4A63FF;
        padding-left: 14px;
    }

    .dropdown i {
        font-size: 18px;
        width: 20px;
        text-align: center;
        color: #4a63ff;
    }

    .dropdown .text-danger i {
        color: #ff3d3d;
    }


.avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid #000000;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
}


.avatar img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    text-align: center;
    justify-content: center;
    border-radius: 50%;
    padding: 5px !important;
}
 
</style>


<div class="header">
    <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center" style="gap:20px;">
            <button class="sidebar-toggle" id="sidebarToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="icon-group">
            <div class="avatar-wrapper">
    <div class="avatar" id="avatarBtn">
        <img src="{{ asset('assets/images/header-logo.png') }}">
    </div>

    <div class="dropdown" id="dropdownMenu">
        <a href="{{ url('admin/logout') }}" class="text-danger">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>
</div>

        </div>
    </div>
</div>

<div class="search-bar-dropdown">
    <div class="d-flex align-center">
        <span class="material-symbols-outlined">search</span>
        <input type="text" placeholder="Search People">
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(function () {

    // Sidebar Open
    $('#sidebarToggle').on('click', function () {
        $('.sidebar').addClass('open');
        $('.sidebar-overlay').fadeIn(200);
    });

    // Sidebar Close
    $('.sidebar-overlay').on('click', function () {
        $('.sidebar').removeClass('open');
        $(this).fadeOut(200);
    });

});

/* Avatar Dropdown */
const avatarBtn = document.getElementById('avatarBtn');
const dropdownMenu = document.getElementById('dropdownMenu');

avatarBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    dropdownMenu.style.display =
        dropdownMenu.style.display === 'flex' ? 'none' : 'flex';
});

document.addEventListener('click', () => {
    dropdownMenu.style.display = 'none';
});
</script>

<script>
    $(function() {

        // Sidebar open
        $('#sidebarToggle').on('click', function() {
            $('.sidebar').addClass('open');
            $('body').addClass('sidebar-open');
            $('.sidebar-overlay').show();
        });

        // Sidebar close (icon)
        $('.sidebar-close').on('click', function() {
            $('.sidebar').removeClass('open');
            $('body').removeClass('sidebar-open');
            $('.sidebar-overlay').hide();
        });

        // Sidebar close (overlay)
        $('.sidebar-overlay').on('click', function() {
            $('.sidebar').removeClass('open');
            $('body').removeClass('sidebar-open');
            $(this).hide();
        });

    });

    // Avatar dropdown
    const avatarBtn = document.getElementById('avatarBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');

    avatarBtn.addEventListener('click', () => {
        dropdownMenu.style.display =
            dropdownMenu.style.display === 'flex' ? 'none' : 'flex';
    });

    document.addEventListener('click', (e) => {
        if (!avatarBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
</script>
