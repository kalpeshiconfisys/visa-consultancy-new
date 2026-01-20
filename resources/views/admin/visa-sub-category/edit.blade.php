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

        .toc-card {
            border: 1px dashed #cfd4da;
            border-radius: 10px;
            padding: 15px;
            background: #fafafa;
        }
    </style>

    <div class="content-wrapper d-flex justify-content-center">
        <div class="col-12 col-xl-11 col-lg-10 col-md-11 m-auto">
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
                                    <label class="fw-bold mb-1">Select Visa Category <span
                                            class="text-danger">*</span></label>
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
                                <label class="fw-bold">Title <span class="text-danger">*</span></label>
                                <input type="text" name="sub_title" class="form-control" placeholder="Enter Title"
                                    value="{{ $subCategories->title }}" required>
                            </div>
                            <div class="mt-2 descBox">
                                <label class="fw-bold">Description <span class="text-danger">*</span></label>
                                <textarea name="sub_description" class="form-control" id="editor" rows="2" placeholder="Enter Description"
                                    required>{{ $subCategories->description }}</textarea>
                            </div>
                        </div>
                        <hr>
                        <div class=" d-flex  justify-content-between col-12-sm mt-3">
                            <h4 class="fw-bold align-content-center">Table Of Content</h4>
                            <button type="button" class="btn btn-outline-primary addSubCategory mb-3">+ Add Table Of
                                Content</button>
                        </div>
                        <div id="subCategoryWrapper">
                            @php
                                $subContents = $subCategories->table_of_content ?? [];
                            @endphp

                            @if (count($subContents) > 0)
                                @foreach ($subContents as $i => $sub)
                                    <div class="subCategoryBox toc-card p-3 mb-3  " data-index="{{ $i }}">
                                        <div class="d-flex justify-content-end align-items-center mb-2">
                                            {{-- <h4 class="fw-bold">Table Of Content</h4> --}}
                                            <button type="button" class="remove-subcategory-btn"
                                                title="Remove Table of Content">✕</button>
                                        </div>

                                        <input type="hidden" name="id[]" value="{{ $sub['id'] ?? '' }}">
                                        <label class="fw-bold">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title[]" class="form-control"
                                            value="{{ $sub['title'] ?? '' }}" required>

                                        <div class="mt-2 descBox">
                                            <label class="fw-bold">Description</label>
                                            <textarea name="description[]" class="form-control" id="toc-description" rows="2">{{ $sub['description'] ?? '' }}</textarea>
                                        </div>

                                        {{-- <div class="mt-2 bulletsArea">
                                            <label class="fw-bold">Bullets</label>
                                            <div class="bulletWrapper">
                                                @if (isset($sub['bullets']) && count($sub['bullets']) > 0)
                                                    @foreach ($sub['bullets'] as $b)
                                                        <div class="row bulletItem mb-2 align-items-center">
                                                            <div class="col-10">
                                                                <input type="text" name="bullets[{{ $i }}][]"
                                                                    class="form-control" value="{{ $b }}"
                                                                    placeholder="Enter bullet">
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
                                                                class="form-control" placeholder="Enter bullet">
                                                        </div>
                                                        <div class="col-2 text-start">
                                                            <button type="button"
                                                                class="bullet-remove-btn removeBullet">✕</button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <button type="button" class="btn btn-sm btn-outline-success addBullet  mt-1">+
                                                Add
                                                Bullet</button>
                                        </div> --}}
                                    </div>
                                @endforeach
                            @else
                                <!-- Default empty block -->
                                <div class="subCategoryBox toc-card p-3 mb-3  " data-index="0">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h4 class="fw-bold">Table Of Content</h4>
                                        <button type="button" class="remove-subcategory-btn"
                                            title="Remove Table of Content">✕</button>
                                    </div>
                                    <label class="fw-bold">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title[]" class="form-control" required>
                                    <div class="mt-2 descBox">
                                        <label class="fw-bold">Description</label>
                                        <textarea name="description[]" class="form-control" id="toc-description" rows="2"></textarea>
                                    </div>
                                    {{-- <div class="mt-2 bulletsArea">
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
                                        <button type="button" class="btn btn-sm btn-outline-success addBullet  mt-1">+ Add Bullet</button>
                                    </div> --}}
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
        $(document).ready(function() {
            $('#editor , #toc-description').summernote({
                height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'italic']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', ]],
                    ['view', ['codeview', 'help']]
                ],

                callbacks: {
                    onImageUpload: function(files) {
                        var maxFileSize = 3 * 1024 * 1024; // 3 MB
                        for (var i = 0; i < files.length; i++) {
                            var file = files[i];
                            if (file.size <= maxFileSize) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    // Use current editor reference
                                    $(this).summernote('insertImage', e.target.result);
                                }.bind(this);
                                reader.readAsDataURL(file);
                            } else {
                                alert('Image size exceeds the 3 MB limit.');
                            }
                        }
                    },
                    // Remove this if you want to preserve formatting
                    onPaste: function(e) {
                        e.preventDefault();
                        let text = (e.originalEvent || e).clipboardData.getData('text/plain');

                        // Preserve new lines
                        text = text.replace(/\n/g, '<br>');

                        $(this).summernote('pasteHTML', text);
                    }

                }
            });
        });

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
        // $(".addSubCategory").on("click", function() {
        //     let box = $(".subCategoryBox").first().clone();
        //     box.find("input[type=text]").val("");
        //     box.find("textarea").val("");
        //     box.find(".bulletWrapper .bulletItem").not(":first").remove();

        //     box.attr("data-index", index);

        //     // Update bullet input name
        //     box.find(".bulletWrapper input[name^='bullets']").attr("name", "bullets[" + index + "][]");

        //     // Show remove button
        //     box.find(".remove-subcategory-btn").show();

        //     $("#subCategoryWrapper").append(box);
        //     applyContentRule(box);
        //     index++;
        // });

        $(".addSubCategory").on("click", function() {

            // 1️⃣ Destroy summernote before cloning
            $("#subCategoryWrapper textarea[name='description[]']").summernote('destroy');

            let box = $(".subCategoryBox").first().clone();

            // 2️⃣ Clear normal inputs
            box.find("input[type=text]").val("");

            // 3️⃣ Properly reset textarea (THIS IS IMPORTANT)
            box.find("textarea")
                .val("") // backend ma NULL jase
                .html("") // editor empty rehse
                .removeAttr("id");

            box.find(".remove-subcategory-btn").show();
            // 4️⃣ Remove extra bullets
            box.find(".bulletWrapper .bulletItem").not(":first").remove();

            $("#subCategoryWrapper").append(box);

            // 5️⃣ Re-init Summernote (editor visible rehse)
            $("#subCategoryWrapper textarea[name='description[]']").each(function() {
                if (!$(this).next('.note-editor').length) {
                    $(this).summernote({
                        height: 400,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'clear', 'italic']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture',]],
                            ['view', ['codeview', 'help']]
                        ]
                    });
                }
            });
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
                    <input type="text" name="bullets[${idx}][]" class="form-control" placeholder="Enter bullet" >
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
