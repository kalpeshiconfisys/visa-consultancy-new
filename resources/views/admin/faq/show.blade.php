@extends('admin.layouts.app')

@section('title', 'FAQ Details')

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
                            <h3 class="fw-bold text-primary mb-1">
                                <i class="fas fa-passport me-2"></i>
                                {{ $faq->question }}
                            </h3>
                            <small class="text-muted">Faq – Detailed Overview</small>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.faq.edit', trim(base64_encode($faq->id), '=')) }}"
                                class="btn btn-outline-primary">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <a href="{{ url('admin/faq') }}" class="btn btn-outline-danger">
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
                    <div class="col-lg-12">
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold border-bottom pb-2 mb-3 text-primary">
                                    About This Faq
                                </h5>
                                <div class="content-area mt-3">
                                    {!! $faq->question  !!}
                                </div>
                                <div class="content-area mt-3">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection
