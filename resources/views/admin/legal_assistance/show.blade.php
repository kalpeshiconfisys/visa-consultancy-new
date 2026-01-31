@extends('admin.layouts.app')

@section('title', 'Legal Assistance Details')

@section('content')

    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12 col-xl-11 m-auto">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div>
                            <h3 class="fw-bold text-primary mb-1">
                                <i class="fas fa-passport me-2"></i>
                                {{ $data->title }}
                            </h3>
                            <small class="text-muted">Legal Assistance – Detailed Overview</small>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.legal-assistance.edit', trim(base64_encode($data->id), '=')) }}"
                                class="btn btn-outline-primary">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <a href="{{ route('admin.legal-assistance.index') }}" class="btn btn-outline-danger">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-11 m-auto">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold border-bottom pb-2 mb-3 text-primary">
                                    About This
                                </h5>

                                <div class="content-area mt-3">
                                    {!! $data->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        @if ($data->image)
                            <div class="card border-0 shadow-sm rounded-4 sticky-box">
                                <div class="card-body p-3">
                                    <h6 class="fw-bold mb-3 text-primary">
                                        <i class="fas fa-image me-1"></i>
                                        Media
                                    </h6>
                                    <div class="row g-3"> 
                                        @if ($data->image)
                                            <div class="col-6 text-left">
                                                <img src="{{ $data->image }}" class="img-fluid rounded shadow-sm "
                                                    style="width:100px; height:80px; object-fit:cover;">
                                                <small class="text-muted d-block mt-1">Image</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
