{{-- @extends('admin.layouts.app')

@section('title', 'Edit Visa Sub Category')

@section('content')

    <style>
        .bullet-remove-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #dc3545;
            border: none;
            color: white;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.2s;
        }

        .bullet-remove-btn:hover {
            background: #b02a37;
        }
    </style>

    <div class="content-wrapper d-flex justify-content-center fw-bold ">
        <div class="col-12 col-xl-10 col-lg-10 col-md-11 m-auto">
            <div class="card shadow-sm border-0 rounded-4 my-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="fw-bold">Edit Visa Sub Category</h4>
                        <a href="{{ route('admin.visa-sub-category.index') }}" class="btn btn-outline-danger">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <form action="{{ route('admin.visa-sub-category.update', $subCategories->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class=" col-6 mb-4">
                                <label class="fw-bold mb-1">Select Visa Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $cat)
                                        <option class="fw-bold" value="{{ $cat->id }}"
                                            {{ $subCategories->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" col-6 mb-4">
                                <label class="fw-bold mb-1">Content Type</label>
                                <div class="col-12 mb-4">
                                    <select id="contentType" class="form-control" name="content_type" required>
                                        <option class="fw-bold" value="both"
                                            {{ $subCategories->content_type == 'both' ? 'selected' : '' }}>
                                            Description + Bullets
                                        </option>
                                        <option class="fw-bold" value="description"
                                            {{ $subCategories->content_type == 'description' ? 'selected' : '' }}>
                                            Only Description
                                        </option>
                                        <option class="fw-bold" value="bullets"
                                            {{ $subCategories->content_type == 'bullets' ? 'selected' : '' }}>
                                            Only Bullets
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="subCategoryWrapper">
                            @php
                                $bullets = $subCategories->bullets ? json_decode($subCategories->bullets, true) : [];
                            @endphp
                            <div class="subCategoryBox card p-3 mb-3 border rounded shadow-sm" data-index="0">
                                <input type="hidden" name="id[]" value="{{ $subCategories->id }}">
                                <label class="fw-bold">Title</label>
                                <input type="text" name="title[]" value="{{ $subCategories->title }}"
                                    class="form-control" required>
                                <div class="mt-2 descBox">
                                    <label class="fw-bold">Description</label>
                                    <textarea name="description[]" class="form-control" rows="2">{{ $subCategories->description }}</textarea>
                                </div>
                                <div class="mt-2 bulletsArea">
                                    <label class="fw-bold">Bullets</label>
                                    <div class="bulletWrapper">
                                        @if (count($bullets) > 0)
                                            @foreach ($bullets as $b)
                                                <div class="row bulletItem mb-2  align-items-center">

                                                    <div class="col-10">
                                                        <input type="text" name="bullets[0][]"
                                                            value="{{ $b }}" class="form-control"
                                                            placeholder="Enter bullet">
                                                    </div>

                                                    <div class="col-2 text-start ">
                                                        <button type="button" class="bullet-remove-btn removeBullet">
                                                            ✕
                                                        </button>
                                                    </div>

                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row bulletItem mb-2 align-items-center">
                                                <div class="col-8">
                                                    <input type="text" name="bullets[0][]" class="form-control"
                                                        placeholder="Enter bullet">
                                                </div>
                                                <div class="col-4 text-start">
                                                    <button type="button" class="bullet-remove-btn removeBullet">
                                                        ✕
                                                    </button>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                    <button type="button" class="btn btn-sm btn-success addBullet  mt-1">
                                        + Add Bullet
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" name="publish_is" value="1"
                                class="btn btn-secondary px-4   ">
                                Draft
                            </button>
                            <button type="submit" name="publish_is" value="2"
                                class="btn btn-secondary px-4   ">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>

        function applyContentRule(box) {
            let type = $("#contentType").val();
            if (type === "description") {
                box.find(".descBox").show();
                box.find(".bulletsArea").hide();
            } else if (type === "bullets") {
                box.find(".descBox").hide();
                box.find(".bulletsArea").show();
            } else {
                box.find(".descBox").show();
                box.find(".bulletsArea").show();
            }
        }

        applyContentRule($(".subCategoryBox"));

        $("#contentType").on("change", function() {
            $(".subCategoryBox").each(function() {
                applyContentRule($(this));
            });
        });

        $(document).on("click", ".addBullet", function() {
            let box = $(this).closest(".subCategoryBox");
            let idx = box.data("index");
            box.find(".bulletWrapper").append(`
                <div class="row bulletItem mb-2 align-items-center">
                    <div class="col-10">
                        <input type="text"
                            name="bullets[${idx}][]"
                            class="form-control"
                            placeholder="Enter bullet">
                    </div>
                    <div class="col-2 text-start">
                        <button type="button"
                            class="bullet-remove-btn removeBullet">
                            ✕
                        </button>
                    </div>
                </div>
            `);
        });

        $(document).on("click", ".removeBullet", function() {
            $(this).closest(".bulletItem").remove();
        });
    </script>

@endsection --}}


@extends('admin.layouts.app')
@section('title', 'Edit Visa Sub Category')
@section('content')

    <style>
        .bullet-remove-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #dc3545;
            border: none;
            color: white;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.2s;
        }

        .bullet-remove-btn:hover {
            background: #b02a37;
        }

        .remove-subcategory-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ffc107;
            border: none;
            color: white;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .remove-subcategory-btn:hover {
            background: #e0a800;
        }
    </style>

    <div class="content-wrapper d-flex justify-content-center fw-bold ">
        <div class="col-12 col-xl-10 col-lg-10 col-md-11 m-auto">
            <div class="card shadow-sm border-0 rounded-4 my-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="fw-bold">Edit Visa Sub Category</h4>
                        <a href="{{ route('admin.visa-sub-category.index') }}" class="btn btn-outline-danger">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <form action="{{ route('admin.visa-sub-category.update', $subCategories->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4 border rounded shadow-sm mt-3 p-3">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="fw-bold mb-1">Select Visa Category</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}" class="fw-bold"
                                                {{ $subCategories->category_id == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            {{-- <div class="col-6">
                            <label class="fw-bold mb-1">Content Type</label>
                                <select id="contentType" class="form-control" name="content_type" required>
                                    <option value="both" {{ $subCategories->content_type=='both'?'selected':'' }}>Description + Bullets</option>
                                    <option value="description" {{ $subCategories->content_type=='description'?'selected':'' }}>Only Description</option>
                                    <option value="bullets" {{ $subCategories->content_type=='bullets'?'selected':'' }}>Only Bullets</option>
                                </select>
                            </div> --}}
                            </div>
                            <div class="mt-2">
                                <label class="fw-bold">Title</label>
                                <input type="text" name="sub_title" class="form-control" placeholder="Enter Title"
                                    value="{{ $subCategories->title }}" required>
                            </div>
                            <div class="mt-2 descBox">
                                <label class="fw-bold">Description</label>
                                <textarea name="sub_description" class="form-control" rows="2" placeholder="Enter Description" required>{{ $subCategories->description }}</textarea>
                            </div>
                        </div>
                        <hr>
                        <div class=" d-flex  justify-content-between col-12-sm mt-3">
                            <h4 class="fw-bold">Table Of Content</h4>
                            <button type="button" class="btn btn-primary addSubCategory mb-3">+ Add Table Of
                                Content</button>
                        </div>
                        <div id="subCategoryWrapper">
                            @php
                                $subContents = $subCategories->table_of_content ?? [];
                            @endphp

                            @if (count($subContents) > 0)
                                @foreach ($subContents as $i => $sub)
                                    <div class="subCategoryBox card p-3 mb-3 border rounded shadow-sm"
                                        data-index="{{ $i }}">
                                        <div class="d-flex justify-content-end align-items-center mb-2">
                                            {{-- <h4 class="fw-bold">Table Of Content</h4> --}}
                                            <button type="button" class="remove-subcategory-btn"
                                                title="Remove Table of Content">✕</button>
                                        </div>

                                        <input type="hidden" name="id[]" value="{{ $sub['id'] ?? '' }}">
                                        <label class="fw-bold">Title</label>
                                        <input type="text" name="title[]" class="form-control"
                                            value="{{ $sub['title'] ?? '' }}" required>

                                        <div class="mt-2 descBox">
                                            <label class="fw-bold">Description</label>
                                            <textarea name="description[]" class="form-control" rows="2" required>{{ $sub['description'] ?? '' }}</textarea>
                                        </div>

                                        <div class="mt-2 bulletsArea">
                                            <label class="fw-bold">Bullets</label>
                                            <div class="bulletWrapper">
                                                @if (isset($sub['bullets']) && count($sub['bullets']) > 0)
                                                    @foreach ($sub['bullets'] as $b)
                                                        <div class="row bulletItem mb-2 align-items-center">
                                                            <div class="col-10">
                                                                <input type="text" name="bullets[{{ $i }}][]"
                                                                    class="form-control" value="{{ $b }}"
                                                                    placeholder="Enter bullet" required>
                                                            </div>
                                                            <div class="col-2 text-start">
                                                                <button type="button"
                                                                    class="bullet-remove-btn removeBullet">✕</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="row bulletItem mb-2 align-items-center">
                                                        <div class="col-10">
                                                            <input type="text" name="bullets[{{ $i }}][]"
                                                                class="form-control" placeholder="Enter bullet" required>
                                                        </div>
                                                        <div class="col-2 text-start">
                                                            <button type="button"
                                                                class="bullet-remove-btn removeBullet">✕</button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <button type="button" class="btn btn-sm btn-success addBullet  mt-1">+ Add
                                                Bullet</button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Default empty block -->
                                <div class="subCategoryBox card p-3 mb-3 border rounded shadow-sm" data-index="0">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h4 class="fw-bold">Table Of Content</h4>
                                        <button type="button" class="remove-subcategory-btn"
                                            title="Remove Table of Content">✕</button>
                                    </div>
                                    <label class="fw-bold">Title</label>
                                    <input type="text" name="title[]" class="form-control" required>
                                    <div class="mt-2 descBox">
                                        <label class="fw-bold">Description</label>
                                        <textarea name="description[]" class="form-control" rows="2"></textarea>
                                    </div>
                                    <div class="mt-2 bulletsArea">
                                        <label class="fw-bold">Bullets</label>
                                        <div class="bulletWrapper">
                                            <div class="row bulletItem mb-2 align-items-center">
                                                <div class="col-10">
                                                    <input type="text" name="bullets[0][]" class="form-control"
                                                        placeholder="Enter bullet">
                                                </div>
                                                <div class="col-2 text-start">
                                                    <button type="button"
                                                        class="bullet-remove-btn removeBullet">✕</button>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-success addBullet  mt-1">+ Add
                                            Bullet</button>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            {{-- <button type="submit" name="publish_is" value="1" class="btn btn-primary px-4 ">Draft</button> --}}
                            <button type="submit" name="publish_is" value="2"
                                class="btn  btn-outline-success px-4 ">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        let index = $("#subCategoryWrapper .subCategoryBox").length;

        function applyContentRule(box) {
            let type = $("#contentType").val();
            if (type === "description") {
                box.find(".descBox").show();
                box.find(".bulletsArea").hide();
            } else if (type === "bullets") {
                box.find(".descBox").hide();
                box.find(".bulletsArea").show();
            } else {
                box.find(".descBox").show();
                box.find(".bulletsArea").show();
            }
        }

        $("#contentType").on("change", function() {
            $(".subCategoryBox").each(function() {
                applyContentRule($(this));
            });
        });
        applyContentRule($(".subCategoryBox"));

        // Add Table Of Content
        $(".addSubCategory").on("click", function() {
            let box = $(".subCategoryBox").first().clone();
            box.find("input[type=text]").val("");
            box.find("textarea").val("");
            box.find(".bulletWrapper .bulletItem").not(":first").remove();

            box.attr("data-index", index);

            // Update bullet input name
            box.find(".bulletWrapper input[name^='bullets']").attr("name", "bullets[" + index + "][]");

            // Show remove button
            box.find(".remove-subcategory-btn").show();

            $("#subCategoryWrapper").append(box);
            applyContentRule(box);
            index++;
        });

        // Remove Table Of Content (only extra blocks)
        $(document).on("click", ".remove-subcategory-btn", function() {
            let boxes = $("#subCategoryWrapper .subCategoryBox");
            if (boxes.length > 1) {
                $(this).closest(".subCategoryBox").remove();
            } else {
                alert("Cannot remove the last Table of Content.");
            }
        });

        // Add Bullet
        $(document).on("click", ".addBullet", function() {
            let box = $(this).closest(".subCategoryBox");
            let idx = box.data("index");
            box.find(".bulletWrapper").append(`
            <div class="row bulletItem mb-2 align-items-center">
                <div class="col-10">
                    <input type="text" name="bullets[${idx}][]" class="form-control" placeholder="Enter bullet" required>
                </div>
                <div class="col-2 text-start">
                    <button type="button" class="bullet-remove-btn removeBullet">✕</button>
                </div>
            </div>
        `);
        });

        // Remove Bullet
        $(document).on("click", ".removeBullet", function() {
            $(this).closest(".bulletItem").remove();
        });

        // Hide remove button for first Table of Content by default
        $("#subCategoryWrapper .subCategoryBox").first().find(".remove-subcategory-btn").hide();
    </script>

@endsection
