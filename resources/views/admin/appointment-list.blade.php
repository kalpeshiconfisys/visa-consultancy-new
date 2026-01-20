@extends('admin.layouts.app')
@section('title', 'Enquiry List')
@section('content')
    <div class="content-wrapper d-flex justify-content-center">
        <div class="col-12 col-xl-11 col-lg-9 col-md-10 m-auto">
            <div class="card shadow-sm border-0 rounded-0 my-4">
                <div class="card-body p-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title text-dark fw-bold m-0">Appointment List</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light fw-bold">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Preferred Date</th>
                                    <th>preferred_time_id</th>
                                    <th>consultation_method_id</th>
                                </tr>
                            </thead>
                            <tbody>


                                @forelse($appointmentlist as $key => $i)
                                    <tr>
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
                        <!-- Pagination -->
                        <div class="d-flex justify-content-end mt-1">
                            {{ $appointmentlist->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
