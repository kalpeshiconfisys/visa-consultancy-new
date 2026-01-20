@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

    <style>
        .hover-card {
            transition: all 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .hover-card:hover .icon {
            background: #0d6efd;
            transform: scale(1.1);
            transition: 0.3s;
        }
    </style>

    <div class="container-fluid py-4">
        {{-- Welcome Card --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h3 class="fw-bold mb-1">Welcome Back, {{ auth()->guard('admin')->user()->name }} 👋</h3>
                    <p class="text-muted mb-0">
                        Manage visa categories, applications, clients and appointments from here.
                    </p>
                </div>
            </div>
        </div>
        {{-- Summary Cards --}}
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <a href="{{ url('admin/visa-category') }}">
                    <div class="card border-0 shadow-sm rounded-4 p-3 hover-card">
                        <div class="d-flex align-items-center">
                            <div class="icon bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                                style="width:50px;height:50px;">
                                <i class="fa-solid fa-passport"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0">Visa Categories</h6>
                                <h4 class="fw-bold mb-0">{{ \App\Models\VisaCategory::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        {{-- Recent Applications --}}
        <div class="row">
            <div class="col-6">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Enquiry List</h6>

                <a href="{{url('admin/enquiry-list')}}"
                   class="btn btn-sm btn-outline-primary ">
                    View More
                    <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
                 </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light fw-bold">
                                <tr>
                                    <th>#</th>
                                    <th>Visa Category</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $enquiries = \App\Models\Enquiry::latest()->take(5)->get();
                                @endphp

                                @forelse($enquiries as $key => $enquiry)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $enquiry->visa_category->title }}</td>
                                        <td>{{ $enquiry->name }}</td>
                                        <td>{{ $enquiry->email }}</td>
                                        <td>{{ $enquiry->phone ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            No enquiries found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Appointment List</h6>

                <a href="{{url('admin/appointment-list')}}"
                   class="btn btn-sm btn-outline-primary ">
                    View More
                    <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
                 </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light fw-bold">
                                <tr>
                                    <th>#</th>

                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Preferred Date</th>
                                    <th>preferred_time</th>
                                    <th>consultation_method</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $enquiries = \App\Models\AppointmentRequest::with(['preferredtime','consultationmethod'])->latest()->take(5)->get();
                                @endphp

                                @forelse($enquiries as $key => $enquiry)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>{{ $enquiry->name }}</td>
                                        <td>{{ $enquiry->email }}</td>
                                        <td>{{ $enquiry->phone ?? '-' }}</td>
                                        <td>{{ $enquiry->preferred_date ?? '-' }}</td>
                                        <td>{{ $enquiry->preferredtime->title ?? '-' }}</td>
                                        <td>{{ $enquiry->consultationmethod->title ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            No enquiries found
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
