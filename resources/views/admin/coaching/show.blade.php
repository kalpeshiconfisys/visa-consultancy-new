@extends('admin.layouts.app')

@section('title', 'Coaching Details')

@section('content')
    <style>
        .toc-scroll {
            max-height: 450px;
            overflow-y: auto;
            overflow-x: hidden !important;
        }

        .toc-row {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            max-width: 100%;
            overflow: hidden;
        }


        .toc-number {
            min-width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #0d6efd;
            color: #fff;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }


        .toc-content {
            flex: 1;
            max-width: 100%;
            overflow: hidden;
        }


        .toc-desc,
        .toc-desc * {
            max-width: 100% !important;
            word-break: break-word !important;
            overflow-wrap: break-word !important;
            white-space: normal !important;
        }


        .toc-desc img {
            max-width: 100% !important;
            height: auto !important;
        }


        .toc-desc table,
        .toc-desc pre,
        .toc-desc code {
            max-width: 100%;
            overflow-x: auto;
            display: block;
        }

        .content-area p {
            line-height: 1.9;
            margin-bottom: 12px;
            color: #333;
        }

        .content-area ul {
            padding-left: 22px;
        }

        .content-area li {
            margin-bottom: 6px;
        }

        .toc-scroll {
            max-height: 450px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .toc-item {
            background: #f9fafc;
            border-radius: 10px;
            border: 1px solid #eee;
            transition: 0.3s;
        }

        .toc-item:hover {
            background: #eef4ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .toc-number {
            width: 32px;
            height: 32px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }


        .sticky-box {
            position: sticky;
            top: 90px;
        }


        .toc-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .toc-scroll::-webkit-scrollbar-thumb {
            background: #cfd8e3;
            border-radius: 10px;
        }


        @media (max-width: 992px) {
            .sticky-box {
                position: relative;
                top: auto;
            }

            .toc-scroll {
                max-height: none;
            }
        }
    </style>
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12 col-xl-11 m-auto">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div>
                            <h3 class="fw-bold text-primary mb-1 text-black">
                                <i class="fas fa-passport me-2 "></i>
                                {{ $coaching->title }}
                            </h3>
                            <small class="text-muted">Coaching – Detailed Overview</small>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.coaching.edit', trim(base64_encode($coaching->id), '=')) }}"
                                class="btn custom-theme-color   text-color  ">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <a href="{{ url('admin/coaching') }}" class="btn custom-theme-color   text-color">
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
                                <h5 class="fw-bold   pb-2 mb-3 text-black">
                                    About This Coaching
                                </h5>
                                <div class="content-area mt-3">
                                    {!! $coaching->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        @if ($coaching->image )
                            <div class="card border-0 shadow-sm rounded-4 sticky-box">
                                <div class="card-body p-3">
                                    <h6 class="fw-bold mb-3 text-black">
                                        <i class="fas fa-image me-1"></i>
                                        Media
                                    </h6>
                                    <div class="row g-3">
                                        @if ($coaching->image)
                                            <div class="col-6 text-left ">
                                                <img src="{{ $coaching->image }}" class="img-fluid rounded shadow-sm "
                                                    style="width:100px; height:80px; object-fit:cover;">
                                                <small class="text-muted d-block mt-1">Featured Image</small>
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
