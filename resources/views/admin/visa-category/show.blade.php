@extends('admin.layouts.app')

@section('title', 'Visa Category Details')

@section('content')
<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="row mb-4">
        <div class="col-lg-10 m-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <h3 class="fw-bold mb-1 text-primary">
                            <i class="fas fa-passport me-2"></i>
                            {{ $visaCategory->title }}
                        </h3>
                        <small class="text-muted">Visa Category Details Overview</small>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ url('admin/visa-category/edit', trim(base64_encode($visaCategory->id), '=')) }}"
                           class="btn btn-outline-primary btn-sm px-3">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>

                        <form action="{{ url('admin/visa-category/destroy', trim(base64_encode($visaCategory->id), '=')) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm px-3">
                                <i class="fas fa-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="row">
        <div class="col-lg-10 m-auto">

            <!-- ABOUT VISA -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">

                    <span class="badge bg-primary mb-3">
                        <i class="fas fa-info-circle me-1"></i> About Visa
                    </span>

                    <p class="text-muted fs-6 mb-3">
                        {{ $visaCategory->short_description }}
                    </p>

                    <div class="mb-4">
                        {!! $visaCategory->description !!}
                    </div>

                    <!-- HIGHLIGHTS -->
                    @if(!empty($visaCategory->bullets))
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-star text-warning me-1"></i>
                            Key Highlights
                        </h6>

                        <div class="d-flex flex-wrap gap-2 mb-4">
                            @foreach($visaCategory->bullets as $bullet)
                                <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                    <i class="fas fa-check-circle text-success me-1"></i>
                                    {{ $bullet }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <!-- IMAGES -->
                    <div class="row g-3">
                        @if($visaCategory->image)
                            <div class="col-md-3">
                                <div class="border rounded p-2 text-center">
                                    <img src="{{ $visaCategory->image }}"
                                         class="img-fluid rounded"
                                         alt="Visa Image">
                                    <small class="d-block mt-2 text-muted">Featured Image</small>
                                </div>
                            </div>
                        @endif

                        @if($visaCategory->category_logo)
                            <div class="col-md-3">
                                <div class="border rounded p-2 text-center">
                                    <img src="{{ $visaCategory->category_logo }}"
                                         class="img-fluid rounded"
                                         alt="Category Logo">
                                    <small class="d-block mt-2 text-muted">Category Logo</small>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <!-- TABLE OF CONTENT -->
            @if(!empty($visaCategory->main_table_of_content))
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0">
                        <h4 class="fw-bold mb-0 text-primary">
                            <i class="fas fa-list-ul me-2"></i>
                            Table Of Content
                        </h4>
                    </div>

                    <div class="card-body">
                        @foreach($visaCategory->main_table_of_content as $index => $toc)
                            <div class="border rounded p-3 mb-3">

                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge bg-primary rounded-circle me-2"
                                          style="width:32px;height:32px;display:flex;align-items:center;justify-content:center;">
                                        {{ $index + 1 }}
                                    </span>
                                    <h5 class="fw-bold mb-0">
                                        {{ $toc['title'] }}
                                    </h5>
                                </div>

                                <p class="text-muted ms-4 mb-2">
                                    {{ $toc['description'] }}
                                </p>

                                @if(!empty($toc['bullets']))
                                    <ul class="ms-5">
                                        @foreach($toc['bullets'] as $b)
                                            <li class="mb-1">
                                                <i class="fas fa-check text-success me-1"></i>
                                                {{ $b }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
