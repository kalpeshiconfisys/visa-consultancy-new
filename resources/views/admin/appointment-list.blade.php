@extends('admin.layouts.app')
@section('title', 'Appointment List')
@section('content')
    <div class="content-wrapper d-flex justify-content-center">
        <div class="col-12 col-xl-11 col-lg-9 col-md-10 m-auto">
            <div class="card shadow-sm border-0 rounded-0 my-4">
                <div class="card-body custom-shadow  p-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">

                            <h4 class="card-title text-dark   m-0">Appointment List</h4>

                       <a href="{{ url('admin') }}" class="btn  custom-theme-color   text-color ">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table">
                            <thead class="table-light fw-bold">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Preferred Date</th>
                                    <th>preferred time</th>
                                    <th>consultation method</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($appointmentlist as $key => $i)
                                    <tr class="table-row-muted">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $i->name }}</td>
                                        <td>{{ $i->email }}</td>
                                        <td>{{ $i->phone ?? '-' }}</td>
                                        <td>{{ $i->preferred_date ?? '-' }}</td>
                                        <td>{{ $i->preferredtime->title ?? '-' }}</td>
                                        <td>{{ $i->consultationmethod->title ?? '-' }}</td>
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
                        <div class="d-flex justify-content-end mt-1">
                            {{ $appointmentlist->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
