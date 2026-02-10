@extends('admin.layouts.app')
@section('title', 'Admin Dashboard')

@section('content')

{{-- <style>
/* ===============================
   MOTION SAFETY
================================*/
@media (prefers-reduced-motion: reduce) {
    * {
        animation: none !important;
        transition: none !important;
    }
}

/* ===============================
   PAGE LOAD
================================*/
.dashboard {
    animation: pageFade 0.6s ease-out both;
}

@keyframes pageFade {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* ===============================
   STAGGER CARDS
================================*/
.stat-col {
    animation: slideUp 0.6s ease forwards;
    opacity: 0;
}

.stat-col:nth-child(1){ animation-delay: 0.05s }
.stat-col:nth-child(2){ animation-delay: 0.12s }
.stat-col:nth-child(3){ animation-delay: 0.19s }
.stat-col:nth-child(4){ animation-delay: 0.26s }

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(22px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ===============================
   STAT CARDS
================================*/
.section-card {
    border-radius: 18px;
    background: #fff;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
    transition: all .35s cubic-bezier(.4,0,.2,1);
}

.hover-card:hover {
    transform: translateY(-6px);
    /* box-shadow: 0 20px 45px rgba(13,110,253,.25); */
}

/* ===============================
   ICON
================================*/
.stat-icon {
    width: 58px;
    height: 58px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 22px;
    /* box-shadow: 0 5px 10px rgba(13,110,253,.35); */
    transition: transform .4s ease;
}
.stat-icon-button {
    width: auto;
    height: 35px;
    padding: 0 22px;
    border-radius: 24px;
    display: inline-flex;
    align-items: center;
    justify-content: center;

    border: none;
    outline: none;
    cursor: pointer;

    color: #fff;
    font-size: 15px;
    font-weight: 600;


    /* box-shadow: 0 8px 20px rgba(13,110,253,.35); */

    transition: all .3s ease;
}




.hover-card:hover .stat-icon-button {
    transform: scale(1.12);
}
.hover-card:hover .stat-icon {
    transform: scale(1.12);
}

/* subtle idle float */
@keyframes float {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

/* ===============================
   WELCOME CARD
================================*/
.welcome-card {
    border-radius: 22px;

    color: #fff;
    /* box-shadow: 0 5px 10px rgba(13,110,253,.4); */
    position: relative;
    overflow: hidden;
}

.welcome-card::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, transparent 40%, rgba(255,255,255,.25), transparent 60%);
    animation: shimmer 4.5s linear infinite;
}

@keyframes shimmer {
    from { transform: translateX(-100%); }
    to { transform: translateX(100%); }
}

/* ===============================
   TABLES
================================*/
.table thead th {
    font-size: 12px;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: #6c757d;
}

.table tbody tr {
    transition: background .25s ease;
}

.table tbody tr:hover {
    background: #f5f9ff;
}

/* ===============================
   BUTTON
================================*/
.btn-outline-primary {
    transition: all .3s ease;
}

.btn-outline-primary:hover {
    transform: translateX(4px);
}
</style> --}}


<style>

:root {
    --primary: #1F3A2E;
    --secondary: #C9A24D;
    --page-bg: #F6F8F7;
    --card-bg: #FFFFFF;
    --text-dark: #1F2933;
    --text-muted: #6B7280;
}


body {
    background-color: var(--page-bg);
    color: var(--text-dark);
    font-family: 'Inter', sans-serif;
}


.custom-theme-color {
    background: linear-gradient(135deg, #1F3A2E, #294D3D);
    color: #ffffff !important;
}


.custom-theme-color-s {
    background: linear-gradient(135deg, #C9A24D, #B8913F);
    color: #ffffff !important;
}


.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}


.section-card {
    background-color: var(--card-bg);
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}


.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 35px rgba(0,0,0,0.08);
}


.welcome-card {
    border-radius: 20px;
    color: #fff;
}

.table thead th {
    color: var(--text-muted);
    font-weight: 600;
    border-bottom: 1px solid #E5E7EB;
}

.stat-icon-button {
    border-radius: 30px;
    padding: 6px 16px;
    font-weight: 600;
}

.btn-outline-primary {
    border-color: var(--primary);
    color: var(--primary);
}

.btn-outline-primary:hover {
    background-color: var(--primary);
    color: #fff;
}

.sidebar {
    background-color: #ffffff;
    border-right: 1px solid #E5E7EB;
}


.text-muted {
    color: var(--text-muted) !important;
}

</style>

<div class="container-fluid py-4 dashboard ">

    <!-- Welcome -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 p-4 welcome-card custom-theme-color">
                <h4 class="fw-bold mb-1">
                    Welcome back, {{ auth()->guard('admin')->user()->name }} 👋
                </h4>
                <p class="mb-0 opacity-75">
                    Overview of visas, enquiries and appointments
                </p>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row g-4 mb-5 ">

        <div class="col-xl-3 col-md-6 stat-col ">
            <a href="{{ url('admin/visa-category') }}" class="text-decoration-none text-dark">
                <div class="card p-3 section-card hover-card ">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon  custom-theme-color-s"><i class="fa-solid fa-globe "></i></div>
                        <div class="ms-3">
                            <small class="text-muted fw-semibold">Visa Categories</small>
                            <h3 class="fw-bold   mb-0">{{ $data['total_visa_count'] }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 stat-col">
            <a href="{{ url('admin/blogs') }}" class="text-decoration-none text-dark">
                <div class="card p-3 section-card hover-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon custom-theme-color-s"><i class="fa-solid fa-blog"></i></div>
                        <div class="ms-3">
                            <small class="text-muted fw-semibold">Blogs</small>
                            <h3 class="fw-bold   mb-0">{{ $data['total_blog'] }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>



        <div class="col-xl-3 col-md-6 stat-col">
            <a href="{{ url('admin/coaching') }}" class="text-decoration-none text-dark">
                <div class="card p-3 section-card hover-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon custom-theme-color-s"><i class="fa-solid fa-headset"></i></div>
                        <div class="ms-3">
                            <small class="text-muted fw-semibold">Coaching</small>
                            <h3 class="fw-bold  mb-0">{{ $data['total_coaching'] }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 stat-col">
            <a href="{{ url('admin/testimonials') }}" class="text-decoration-none text-dark">
                <div class="card p-3 section-card hover-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon custom-theme-color-s"><i class="fa-solid fa-headset"></i></div>
                        <div class="ms-3">
                            <small class="text-muted fw-semibold">Testimonial</small>
                            <h3 class="fw-bold  mb-0">{{ $data['total_testimonials'] }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <!-- Tables -->
    <div class="row g-4">

        <div class="col-lg-6 stat-col">
            <div class="card p-4 section-card h-100">
                <div class="d-flex justify-content-between mb-3">
                    <h6 class="   mb-0">
                        <i class="fa-solid fa-envelope-open-text me-2"></i>Recent Enquiries
                    </h6>
                    <a href="{{ url('admin/enquiry-list') }}" class="btn btn-sm btn-outline-primary stat-icon-button custom-theme-color">
                        View All
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table  ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Visa</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                             <th class="text-dark"> Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data['total_enquiry'] as $key => $enquiry)
                            <tr class="table-row-muted">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $enquiry->visa_category->title ?? '-' }}</td>
                                <td>{{ $enquiry->name }}</td>
                                <td>{{ $enquiry->email }}</td>
                                <td>{{ $enquiry->phone ?? '-' }}</td>
                                  <td>{{ $enquiry->created_at ? $enquiry->created_at->format('Y-m-d') : '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted">No enquiries</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 stat-col">
            <div class="card p-4 section-card h-100">
                <div class="d-flex justify-content-between mb-3">
                    <h6 class="   mb-0">
                        <i class="fa-solid fa-calendar-check me-2"></i>Recent Appointments
                    </h6>
                    <a href="{{ url('admin/appointment-list') }}" class="btn btn-sm btn-outline-primary stat-icon-button custom-theme-color">
                        View All
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Method</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data['total_appointment'] as $key => $app)
                            <tr class="table-row-muted">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $app->name }}</td>
                                <td>{{ $app->email }}</td>
                                <td>{{ $app->preferred_date }}</td>
                                <td>{{ $app->preferredtime->title ?? '-' }}</td>
                                <td>{{ $app->consultationmethod->title ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted">No appointments</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.querySelectorAll('.stat-icon').forEach(icon => {
    icon.style.animation = 'float 3.5s ease-in-out infinite';
});
</script>

@endsection
