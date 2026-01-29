@extends('admin.layouts.app')

@section('title', 'Edit Blog')

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

    <div class="content-wrapper d-flex justify-content-center ">
        <div class="col-12 col-xl-11 col-lg-9 col-md-10 m-auto">
            <div class="card shadow-sm border-0 rounded-4 my-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold m-0">Edit Blog</h4>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-danger">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <form action="{{ route('admin.blogs.update', trim(base64_encode($blog->id), '=')) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-4 border rounded shadow-sm mt-3 pb-3">
                            <div class="col-lg-7 col-md-12">
                                <div>
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        value="{{ old('title', $blog->title) }}" required>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">Full Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="editor" name="description" rows="5" style="height:400px" required>{{ old('description', $blog->description) }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12">
                                <div class="mt-3">
                                    <label class="form-label">Featured Image</label>
                                    <input type="file" class="form-control" name="image" id="imageInput"
                                        accept="image/png,image/jpeg,image/webp">
                                    @if ($blog->image)
                                        <div class="mt-3"> <img id="previewImage" src="{{ $blog->image }}"
                                                class="img-fluid rounded shadow-sm border"
                                                style="width:120px;border-radius:8px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            {{-- <button type="submit" name="publish_is" value="1"
                                class="btn btn-outline-primary px-4 ">Draft</button> --}}
                            <button type="submit" name="publish_is" value="2"
                                class="btn btn-outline-success px-4 ">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const imgInput = document.getElementById("imageInput");
            const preview = document.getElementById("previewImage");
            imgInput.addEventListener("change", function(e) {
                const file = e.target.files[0];
                if (file) {
                    preview.src = URL.createObjectURL(file);
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // IMAGE PREVIEW
            const imgInput = document.getElementById("imageInputLogo");
            const preview = document.getElementById("previewImageLogo");
            imgInput.addEventListener("change", function(e) {
                const file = e.target.files[0];
                if (file) {
                    preview.src = URL.createObjectURL(file);
                }
            });
        });

        $(document).ready(function() {
            $('#editor , #toc-description').summernote({
                height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'italic']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture' ]],
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

        $(document).on("click", ".addOutSideBullet", function() {
            let bulletBox = $(this).closest(".bulletsArea");
            let html = `
                <div class="row bulletItem mb-2 align-items-center">
                    <div class="col-10">
                        <input type="text" name="category_bullets[]" class="form-control" placeholder="Enter bullet" required>
                    </div>
                    <div class="col-2 text-start">
                        <button type="button" class="bullet-remove-btn removeBullet">✕</button>
                    </div>
                </div>`;
            bulletBox.find(".addOutSideBullet").before(html);
        });

        $(document).on("click", ".removeBullet", function() {
            $(this).closest(".bulletItem").remove();
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
                            ['insert', ['link', 'picture']],
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


        $(document).on("click", ".removeBullet", function() {
            $(this).closest(".bulletItem").remove();
        });

        $(document).on("click", ".addBullet", function() {
            let bulletBox = $(this).closest(".bulletsArea");
            let parentIndex = bulletBox.closest(".subCategoryBox").index(); // get correct index
            let html = `
            <div class="row bulletItem mb-2 align-items-center">
                <div class="col-10">
                    <input type="text" name="bullets[` + parentIndex + `][]" class="form-control" placeholder="Enter bullet"  >
                </div>
                <div class="col-2 text-start">
                    <button type="button" class="bullet-remove-btn removeBullet">✕</button>
                </div>
            </div>
        `;
            bulletBox.find(".addBullet").before(html);
        });

        $("#subCategoryWrapper .subCategoryBox").first().find(".remove-subcategory-btn").hide();
    </script>

@endsection
