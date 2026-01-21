@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<style>
    .hover-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 22px;
        color: #fff;
    }

    .table thead th {
        font-size: 14px;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .card-title {
        font-weight: 600;
    }
</style>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <h4 class="fw-bold mb-1">
                    Welcome Back, {{ auth()->guard('admin')->user()->name }} 👋
                </h4>
                <p class="text-muted mb-0">
                    Manage visa categories, enquiries, appointments and clients from your dashboard.
                </p>
            </div>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <a href="{{ url('admin/visa-category') }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm rounded-4 p-3 hover-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary">
                            <i class="fa-solid fa-passport"></i>
                        </div>
                        <div class="ms-3">
                            <small class=" fw-bold">Visa Categories</small>
                            <h4 class="fw-bold mb-0">{{ $data['total_visa_count'] }}</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <a href="{{ url('admin/preferred-time') }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm rounded-4 p-3 hover-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary">
                            <i class="fa-solid fa-passport"></i>
                        </div>
                        <div class="ms-3">
                            <small class=" fw-bold">Appointment Time</small>
                            <h4 class="fw-bold mb-0">{{ $data['total_preferred_time'] }}</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <a href="{{ url('admin/company-advantages') }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm rounded-4 p-3 hover-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary">
                            <i class="fa-solid fa-passport"></i>
                        </div>
                        <div class="ms-3">
                            <small class=" fw-bold">Company Advantages</small>
                            <h4 class="fw-bold mb-0">{{ $data['total_company_advantages'] }}</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <a href="{{ url('admin/consultation-method') }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm rounded-4 p-3 hover-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary">
                            <i class="fa-solid fa-passport"></i>
                        </div>
                        <div class="ms-3">
                            <small class="  fw-bold">Consultation Method</small>
                            <h4 class="fw-bold mb-0">{{ $data['total_consultation_method'] }}</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">Recent Enquiries</h6>
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
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">Recent Appointments</h6>
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
