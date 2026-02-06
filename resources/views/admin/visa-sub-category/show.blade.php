@extends('admin.layouts.app')

@section('title', 'Visa Sub Category Details')

@section('content')

<style>
    /* Table of content design */
    .toc-scroll {
        max-height: 500px;
        overflow-y: auto;
        padding-right: 10px;
    }

    .toc-item {
        background: #f9fbff;
        border-radius: 12px;
        border: 1px solid #e3e9f3;
        transition: 0.3s;
    }

    .toc-item:hover {
        background: #eef4ff;
        transform: translateY(-2px);
    }

    .toc-number {
        min-width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #0d6efd;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 15px;
        flex-shrink: 0;
    }

    .toc-desc {
        word-break: break-word;
        overflow-wrap: break-word;
    }

    .toc-bullets li {
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .toc-scroll {
            max-height: 350px;
        }
    }
</style>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="row mb-4">

        <div class="col-12 col-xl-11 m-auto">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div>
                            <h3 class="fw-bold text-primary mb-1 text-black">
                                <i class="fas fa-passport me-2  "></i>
                                {{ $visaSubCategory->title }}
                            </h3>
                           <small class="text-muted">Visa Sub Category Overview</small>
                        </div>
                        <div class="d-flex gap-2 mt-3 mt-md-0">
                        <a href="{{ route('admin.visa-sub-category.edit', trim(base64_encode($visaSubCategory->id), '=')) }}"
                            class="btn custom-theme-color   text-color">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('admin.visa-sub-category.index') }}" class="btn custom-theme-color   text-color">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    </div>
                </div>
            </div>
    </div>

    <!-- ABOUT VISA -->
    <div class="row mb-4">
        <div class="col-lg-11 m-auto">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 border-bottom pb-2 mb-3 text-black">
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
        <div class="row mb-4">
            <div class="col-lg-11 m-auto">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-3 text-black">
                            <i class="fas fa-list-ul me-2 "></i>
                            Table Of Content
                        </h5>

                        <div class="toc-scroll">

                            @foreach ($visaSubCategory->table_of_content as $index => $toc)

                                <div class="toc-item mb-3 p-3">

                                    <div class="d-flex gap-3 align-items-start">

                                        <!-- Number -->
                                        <div class="toc-number  custom-theme-color">
                                            {{ $index + 1 }}
                                        </div>

                                        <!-- Content -->
                                        <div class="w-100">

                                            <h6 class="fw-bold mb-1">
                                                {{ $toc['title'] }}
                                            </h6>

                                            <div class="text-muted small toc-desc mb-2">
                                                {!! $toc['description'] !!}
                                            </div>

                                            {{-- Bullets --}}
                                            @if (!empty($toc['bullets']))
                                                <ul class="ps-3 mb-0 toc-bullets">
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
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
