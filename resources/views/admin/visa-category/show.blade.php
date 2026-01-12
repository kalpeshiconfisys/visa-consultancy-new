@extends('admin.layouts.app')

@section('title', 'Visa Category Details')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-lg-11 m-auto">
                <div class="card border-0 shadow-sm bg-light">
                    <div class="card-body py-4 px-4 d-flex flex-wrap justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold text-primary mb-1">
                                <i class="fas fa-passport me-2"></i>
                                {{ $visaCategory->title }}
                            </h2>
                            <p class="text-muted mb-0">
                                Visa Category – Detailed Overview
                            </p>
                        </div>
                        <div class="d-flex gap-2 mt-3 mt-md-0 justify-content-center">
                            <a href="{{ url('admin/visa-category/edit', trim(base64_encode($visaCategory->id), '=')) }}"
                                class="btn btn-outline-primary  ">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <a href="{{ url('admin/visa-category') }}" class="btn btn-outline-danger">
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
                                <h5 class="fw-bold mb-3">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    About This Visa
                                </h5>
                                <p class="text-muted fs-6">
                                    {{ $visaCategory->short_description }}
                                </p>
                                <div class="mt-3">
                                    {!! $visaCategory->description !!}
                                </div>
                            </div>
                        </div>
                        @if (!empty($visaCategory->main_table_of_content))
                            <div class="card border-0 shadow-sm scroll">
                                <div class="card-body">

                                    <h5 class="fw-bold mb-4">
                                        <i class="fas fa-list-ul text-primary me-2"></i>
                                        Table Of Content
                                    </h5>

                                    @foreach ($visaCategory->main_table_of_content as $index => $toc)
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
                    <div class="col-lg-4">

                        <!-- HIGHLIGHTS -->
                        @if (!empty($visaCategory->bullets))
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-star text-warning me-1"></i>
                                        Key Highlights
                                    </h6>

                                    <ul class="list-unstyled mb-0">
                                        @foreach ($visaCategory->bullets as $bullet)
                                            <li class="mb-2 d-flex">
                                                <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                                                <span>{{ $bullet }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <!-- IMAGES -->
                        @if ($visaCategory->image || $visaCategory->category_logo)
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-image text-primary me-1"></i>
                                        Media
                                    </h6>

                                    <div class="row g-3">
                                        @if ($visaCategory->image)
                                            <div class="col-6 text-center">
                                                <img src="{{ $visaCategory->image }}" class="img-fluid rounded w-50">
                                                <small class="text-muted d-block mt-1 text-center">
                                                    Featured Image
                                                </small>
                                            </div>
                                        @endif

                                        @if ($visaCategory->category_logo)
                                            <div class="col-6 text-center">
                                                <img src="{{ $visaCategory->category_logo }}"
                                                    class="img-fluid rounded w-500">
                                                <small class="text-muted d-block mt-1 text-center">
                                                    Category Logo
                                                </small>
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
