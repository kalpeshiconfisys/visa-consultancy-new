@extends('admin.layouts.app')

@section('title', 'Edit Visa Category')

@section('content')

    <style>
        .bullet-remove-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #dc3545;
            border: none;
            color: white;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.2s;
        }
        .bullet-remove-btn:hover {
            background: #b02a37;
        }
        .remove-subcategory-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ffc107;
            border: none;
            color: white;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
        .remove-subcategory-btn:hover {
            background: #e0a800;
        }

        .toc-card {
        border: 1px dashed #cfd4da;
        border-radius: 10px;
        padding: 15px;
        background: #fafafa;
    }
    </style>
    <div class="content-wrapper d-flex justify-content-center fw-bold ">
        <div class="col-12 col-xl-10 col-lg-9 col-md-10 m-auto">
            <div class="card shadow-sm rounded-4 my-4 main-category-card">
                <div class="card-body p-4 ">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold m-0">Edit Appointment Time</h4>
                        <a href="{{ route('admin.preferred-time.index') }}" class="btn btn-outline-danger">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <form action="{{ route('admin.preferred-time.update',trim(base64_encode($preferredTime->id), '=')) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4 border rounded shadow-sm mt-3 pb-3">
                            <div class="col-lg-7 col-md-12 ">
                                <div>
                                    <label class="form-label fw-bold">Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{$preferredTime->title}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit"
                                class="btn btn-outline-success px-4 ">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
