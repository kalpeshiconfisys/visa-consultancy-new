@extends('admin.layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<style>
    .hover-card {
        transition: all 0.35s ease;
        cursor: pointer;
        background: #ffffff;
    }

    .hover-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(13, 110, 253, 0.25);
        border: 1px solid #0d6efd30;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 22px;
        color: #fff;
        background: linear-gradient(135deg, #0d6efd, #4facfe);
        box-shadow: 0 8px 18px rgba(65, 134, 238, 0.4);
    }

    .table thead th {
        font-size: 13px;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody tr:hover {
        background-color: #f5f9ff;
    }

    .welcome-card {
        background: linear-gradient(135deg, #5996f1, #4facfe);
        color: #fff;
        border-radius: 18px;
        box-shadow: 0 15px 40px rgba(13, 110, 253, 0.35);
    }

    .welcome-card p {
        color: #eaf2ff;
    }

    .section-card {
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        border-radius: 18px;
    }
</style>

<div class="container-fluid py-4">

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 p-4 welcome-card">
                <h4 class="fw-bold mb-1">
                    Welcome Back, {{ auth()->guard('admin')->user()->name }} 👋
                </h4>
                <p class="mb-0">
                    Manage visa categories, enquiries, appointments and clients from your dashboard.
                </p>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <a href="{{ url('admin/visa-category') }}" class="text-decoration-none text-dark">
                <div class="card border-0 section-card p-3 hover-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <div class="ms-3">
                            <small class="fw-bold text-muted">Visa Categories</small>
                            <h3 class="fw-bold mb-0 text-primary">{{ $data['total_visa_count'] }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <a href="{{ url('admin/preferred-time') }}" class="text-decoration-none text-dark">
                <div class="card border-0 section-card p-3 hover-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="ms-3">
                            <small class="fw-bold text-muted">Appointment Time</small>
                            <h3 class="fw-bold mb-0 text-primary">{{ $data['total_preferred_time'] }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <a href="{{ url('admin/company-advantages') }}" class="text-decoration-none text-dark">
                <div class="card border-0 section-card p-3 hover-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon">
                            <i class="fa-solid fa-award"></i>
                        </div>
                        <div class="ms-3">
                            <small class="fw-bold text-muted">Company Advantages</small>
                            <h3 class="fw-bold mb-0 text-primary">{{ $data['total_company_advantages'] }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <a href="{{ url('admin/consultation-method') }}" class="text-decoration-none text-dark">
                <div class="card border-0 section-card p-3 hover-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <div class="ms-3">
                            <small class="fw-bold text-muted">Consultation Method</small>
                            <h3 class="fw-bold mb-0 text-primary">{{ $data['total_consultation_method'] }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 section-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-primary">
                        <i class="fa-solid fa-envelope-open-text me-2"></i> Recent Enquiries
                    </h6>
                    <a href="{{ url('admin/enquiry-list') }}" class="btn btn-sm btn-outline-primary">
                        View All <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Visa</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['total_enquiry'] as $key => $enquiry)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $enquiry->visa_category->title ?? '-' }}</td>
                                    <td>{{ $enquiry->name }}</td>
                                    <td>{{ $enquiry->email }}</td>
                                    <td>{{ $enquiry->phone ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        No enquiries found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 section-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-primary">
                        <i class="fa-solid fa-calendar-check me-2"></i> Recent Appointments
                    </h6>
                    <a href="{{ url('admin/appointment-list') }}" class="btn btn-sm btn-outline-primary">
                        View All <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
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
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $app->name }}</td>
                                    <td>{{ $app->email }}</td>
                                    <td>{{ $app->preferred_date ?? '-' }}</td>
                                    <td>{{ $app->preferredtime->title ?? '-' }}</td>
                                    <td>{{ $app->consultationmethod->title ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        No appointments found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
