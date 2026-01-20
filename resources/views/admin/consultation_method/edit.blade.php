@extends('admin.layouts.app')

@section('title', 'Edit Consultation Method')

@section('content') 
    <div class="content-wrapper d-flex justify-content-center fw-bold ">
        <div class="col-12 col-xl-10 col-lg-9 col-md-10 m-auto">
            <div class="card shadow-sm rounded-4 my-4 main-category-card">
                <div class="card-body p-4 ">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold m-0">Edit Consultation Method</h4>
                        <a href="{{ route('admin.consultation-method.index') }}" class="btn btn-outline-danger">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <form action="{{ route('admin.consultation-method.update',trim(base64_encode($method->id), '=')) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4   mt-3 pb-3">
                            <div class="col-lg-7 col-md-12 ">
                                <div>
                                    <label class="form-label fw-bold">Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{$method->title}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="mt-1 d-flex gap-2">
                            <button type="submit"
                                class="btn btn-outline-success px-4 ">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
