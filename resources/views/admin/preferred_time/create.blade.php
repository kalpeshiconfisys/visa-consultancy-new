@extends('admin.layouts.app')

@section('title', 'Add Appointment Time')

@section('content')


    <div class="content-wrapper d-flex justify-content-center fw-bold ">
        <div class="col-12 col-xl-11 col-lg-9 col-md-10 m-auto">
            <div class="card shadow-sm rounded-4 my-4 main-category-card">
                <div class="card-body p-4 ">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class=" m-0">Add Appointment Time</h4>
                        <a href="{{ route('admin.preferred-time.index') }}" class="btn  custom-theme-color   text-color">
                            <i class="bi bi-arrow-left "></i> Back
                        </a>
                    </div>
                    <form action="{{ route('admin.preferred-time.store') }}" method="POST">
                        @csrf

                        <div class="row g-4   rounded   mt-3 pb-3">
                            <div class="col-lg-7 col-md-12 ">
                                <div>
                                    <label class="form-label fw-bold">Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>
                            </div>
                        </div>
                        <div class="mt-1 d-flex gap-2">
                            <button type="submit" name="publish_is" value="2"
                                class="btn custom-theme-color   text-color px-4 ">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
