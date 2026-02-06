@extends('admin.layouts.app')
@section('title', 'Consultation Method List')
@section('content')
    <div class="content-wrapper d-flex justify-content-center">
        <div class="col-12 col-xl-11 col-lg-9 col-md-10 m-auto">
            <div class="card shadow-sm border-0 rounded-0 my-4">
                <div class="card-body custom-shadow  p-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title   m-0 ">Consultation Method List</h4>
                        </div>
                        <a href="{{ route('admin.consultation-method.create') }}"
                           class="btn btn-sm d-flex align-items-center px-3 py-1"
                            style="background-color: #263B27; color: #fff; border-radius: 6px;">
                            <i class="fas fa-plus"></i> Add Consultation Method
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table " style="min-width: 1000px;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-dark">#</th>
                                        <th class="text-dark">Title</th>
                                        <th class="text-dark">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($methods as $key => $i)
                                        <tr class="table-row-muted">
                                            <td class="">{{ $methods->firstItem() + $key }}</td>
                                            <td class="">{{ $i->title }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    {{-- <a href="{{ route('admin.consultation-method.show', trim(base64_encode($i->id), '=')) }}"
                                                        class="btn btn-sm btn-outline-secondary custom-show  px-2  ">
                                                        <i class="fa-solid fa-eye me-1"></i>
                                                    </a> --}}
                                                    <a href="{{ route('admin.consultation-method.edit', trim(base64_encode($i->id), '=')) }}"
                                                        class="btn btn-sm    px-2" title="Edit" >
                                                        <i class="fa-solid fa-pen-to-square me-1"></i>
                                                    </a>
                                                    <button class="btn    px-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $i->id }}" title="Delete">
                                                        <i class="fa-solid fa-trash me-1 text-danger"></i>
                                                    </button>
                                                </div>
                                                <div class="modal fade" id="deleteModal{{ $i->id }}" tabindex="-1"
                                                    aria-labelledby="deleteModalLabel{{ $i->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $i->id }}">
                                                                    Confirm Delete
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this category?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Cancel
                                                                </button>
                                                                <form
                                                                    action="{{ route('admin.consultation-method.destroy', trim(base64_encode($i->id), '=')) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">
                                                                        Yes, Delete
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No Data found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-1">
                            {{ $methods->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
