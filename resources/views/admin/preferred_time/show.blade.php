@extends('admin.layouts.app')

@section('title', 'Appointment Time Details')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-lg-11 m-auto">
                <div class="card border-0 shadow-sm bg-light">
                    <div class="card-body py-4 px-4 d-flex flex-wrap justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold text-primary mb-1">
                                <i class="fas fa-passport me-2"></i>
                                {{ $preferredTime->title }}
                            </h2>
                            <p class="text-muted mb-0">
                                Appointment Time – Detailed Overview
                            </p>
                        </div>
                        <div class="d-flex gap-2 mt-3 mt-md-0 justify-content-center">
                            <a href="{{ route('admin.preferred-time.edit', trim(base64_encode($preferredTime->id), '=')) }}"
                                class="btn btn-outline-primary  ">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <a href="{{ route('admin.preferred-time.index') }}" class="btn btn-outline-danger">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>
                            {{-- <form action="{{ url('admin/visa-category/destroy', trim(base64_encode($visaCategory->id), '=')) }}"
                              method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm px-4">
                                    <i class="fas fa-trash me-1"></i> Delete
                                </button>
                        </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-11 m-auto">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">

                                <p class="text-muted fs-6">
                                    {{ $preferredTime->title }}
                                </p>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection
