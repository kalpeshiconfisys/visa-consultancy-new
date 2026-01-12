@extends('admin.layouts.app')

@section('title', 'Visa Sub Category Details')

@section('content')
    <div class="container-fluid"> 
        <!-- PAGE HEADER -->
        <div class="row mb-4">
            <div class="col-lg-11 m-auto">
                <div class="card border-0 shadow-sm bg-light">
                    <div class="card-body py-4 px-4 d-flex flex-wrap justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-1 text-primary">
                                <i class="fas fa-passport me-2"></i>
                                {{ $visaSubCategory->title }}
                            </h3>
                            <small class="text-muted">Visa Sub Category Overview</small>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.visa-sub-category.edit', trim(base64_encode($visaSubCategory->id), '=')) }}"
                                class="btn btn-outline-primary  ">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <a href="{{ route('admin.visa-sub-category.index') }}" class="btn btn-outline-danger">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>
                            {{-- <form action="{{ route('admin.visa-sub-category.destroy', trim(base64_encode($visaSubCategory->id), '=')) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm   px-3">
                                <i class="fas fa-trash me-1"></i> Delete
                            </button>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-11 m-auto">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    About This Visa
                                </h5>
                                <p class="text-muted fs-6">
                                    {{ $visaSubCategory->title }}
                                </p>
                                <div class="mt-3">
                                    {!! $visaSubCategory->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TABLE OF CONTENT -->
                @if (!empty($visaSubCategory->table_of_content))
                    <div class="card border-0 shadow-sm scroll">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4">
                                <i class="fas fa-list-ul text-primary me-2"></i>
                                Table Of Content
                            </h5>
                            @foreach ($visaSubCategory->table_of_content as $index => $toc)
                                <div class="mb-4">
                                    <div class="d-flex align-items-start mb-2">
                                        <div class="me-3">
                                            <span class="badge bg-primary rounded-circle"
                                                style="width:34px;height:34px;display:flex;align-items:center;justify-content:center;">
                                                {{ $index + 1 }}
                                            </span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">
                                                {{ $toc['title'] }}
                                            </h6>
                                            <p class="text-muted mb-2">
                                                {{ $toc['description'] }}
                                            </p>
                                            @if (!empty($toc['bullets']))
                                                <ul class="ps-3 mb-0">
                                                    @foreach ($toc['bullets'] as $b)
                                                        <li class="mb-1">
                                                            <i class="fas fa-angle-right text-primary me-1"></i>
                                                            {{ $b }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
