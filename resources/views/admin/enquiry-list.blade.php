@extends('admin.layouts.app')
@section('title', 'Enquiry List')
@section('content')
    <div class="content-wrapper d-flex justify-content-center">
        <div class="col-12 col-xl-11 col-lg-9 col-md-10 m-auto">
            <div class="card shadow-sm border-0 rounded-0 my-4">
                <div class="card-body custom-shadow   p-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h4 class="card-title text-dark fw-bold m-0">Enquiry List</h4>
                        <a href="{{ url('admin') }}" class="btn btn-outline-secondary ">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table align-middle " style="min-width: 1000px;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-dark">#</th>
                                        <th class="text-dark">Visa Category</th>
                                        <th class="text-dark">Name</th>
                                        <th class="text-dark"> Email</th>
                                        <th class="text-dark"> Phone</th>
                                        <th class="text-dark">Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($enquiry as $key => $i)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $i->visa_category->title ?? '-' }}</td>
                                            <td>{{ $i->name }}</td>
                                            <td>{{ $i->email }}</td>
                                            <td>{{ $i->phone ?? '-' }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-secondary  custom-show  px-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#messageModal{{ $i->id }}">
                                                    <i class="fa-solid fa-eye me-1"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        {{-- MODAL (IMPORTANT: loop અંદર જ) --}}
                                        <div class="modal fade" id="messageModal{{ $i->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content rounded-4">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">Enquiry Message</h6>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <p class="mb-0">{{ $i->message ?? '-' }}</p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                No enquiries found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-end mt-1">
                            {{ $enquiry->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
