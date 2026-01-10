@extends('admin.layouts.app')

@section('title', 'Visa Category Details')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="row">
        <div class="col-lg-9 m-auto">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold mb-0">
                            <i class="fas fa-passport text-primary me-2"></i>
                            {{ $visaCategory->title }}
                        </h3>
                        <small class="text-muted">Visa Category Overview</small>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ url('admin/visa-category/edit', trim(base64_encode($visaCategory->id), '=')) }}"
                           class="btn btn-outline-primary btn-sm rounded-pill px-3">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>

                        <form action="{{ url('admin/visa-category/destroy', trim(base64_encode($visaCategory->id), '=')) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <!-- CATEGORY DETAILS -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">

                    <span class="badge bg-primary mb-2">About Visa</span>

                    <p class="text-muted fs-6">
                        {{ $visaCategory->short_description }}
                    </p>

                    <div class="mb-4">
                        {!! $visaCategory->description !!}
                    </div>

                    <!-- BULLETS -->
                    @if(!empty($visaCategory->bullets))
                        <h6 class="fw-bold mb-2">
                            <i class="fas fa-star text-warning me-1"></i>
                            Key Highlights
                        </h6>

                        <div class="d-flex flex-wrap gap-2 mb-4">
                            @foreach($visaCategory->bullets as $bullet)
                                <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                    <i class="fas fa-check text-success me-1"></i>
                                    {{ $bullet }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <!-- IMAGES -->
                    <div class="d-flex gap-3">
                        @if($visaCategory->image)
                            <img src="{{ $visaCategory->image }}"
                                 class="rounded shadow-sm"
                                 style="width:140px;">
                        @endif

                        @if($visaCategory->category_logo)
                            <img src="{{ $visaCategory->category_logo }}"
                                 class="rounded shadow-sm"
                                 style="width:140px;">
                        @endif
                    </div>
                </div>
            </div>

            <!-- TABLE OF CONTENT -->
            @if(!empty($visaCategory->main_table_of_content))
                <h4 class="fw-bold mb-3">
                    <i class="fas fa-list-ul text-primary me-2"></i>
                    Table Of Content
                </h4>

                @foreach($visaCategory->main_table_of_content as $index => $toc)
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-body">

                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-primary rounded-circle me-2">
                                    {{ $index + 1 }}
                                </span>
                                <h5 class="fw-bold mb-0 text-primary">
                                    {{ $toc['title'] }}
                                </h5>
                            </div>

                            <p class="text-muted ms-4">
                                {{ $toc['description'] }}
                            </p>

                            @if(!empty($toc['bullets']))
                                <ul class="ms-4 mt-2">
                                    @foreach($toc['bullets'] as $b)
                                        <li class="mb-1">
                                            <i class="fas fa-angle-right text-primary me-1"></i>
                                            {{ $b }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</div>
@endsection
