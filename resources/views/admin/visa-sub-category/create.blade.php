

@extends('admin.layouts.app')

@section('title', 'Add Visa Sub Category')

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
            background: #dc3545;
            border: none;
            color: white;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .remove-subcategory-btn:hover {
            background: #dc3545;
        }

        .toc-card {
            border: 1px dashed #cfd4da;
            border-radius: 10px;
            padding: 15px;
            background: #fafafa;
        }

    </style>

    <div class="content-wrapper d-flex justify-content-center   ">
        <div class="col-12 col-xl-11 col-lg-10 col-md-11 m-auto">
            <div class="card shadow-sm border-0 rounded-4 my-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class=" ">Add Visa Sub Category</h4>
                        <a href="{{ route('admin.visa-sub-category.index') }}" class="btn custom-theme-color   text-color">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <form action="{{ route('admin.visa-sub-category.store') }}" method="POST">
                        @csrf
                        <div class="row g-4 border rounded shadow-sm mt-3 p-3">
                            <div class="row">
                                <div class="col-6 mb-4">
                                    <label class="fw-bold mb-1">Select Visa Category <span
                                            class="text-danger">*</span></label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($categories as $cat)
                                            <option class="fw-bold" value="{{ $cat->id }}">{{ $cat->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="col-6 mb-4">
                                    <label class="fw-bold mb-1">Content Type</label>
                                    <select id="contentType" class="form-control" name="content_type" required>
                                        <option class="fw-bold" value="both">Description + Bullets</option>
                                        <option class="fw-bold" value="description">Only Description</option>
                                        <option class="fw-bold" value="bullets">Only Bullets</option>
                                    </select>
                                </div> --}}
                            </div>

                            <div class="m-0">
                                <label class="fw-bold">Title <span class="text-danger">*</span></label>
                                <input type="text" name="sub_title" class="form-control" placeholder="Enter Title"
                                    required>
                            </div>
                            <div class="mt-2 descBox">
                                <label class="fw-bold">Description <span class="text-danger">*</span></label>
                                <textarea name="sub_description" class="form-control" id="editor" rows="2" placeholder="Enter Description"
                                    required></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class=" d-flex  justify-content-between col-12-sm">
                            <h4 class="  align-content-center">Table Of Content</h4>
                            <button type="button"
                                class="btn custom-theme-color   text-color justify-content-end  addSubCategory mt-2 mb-3">+
                                Add Table Of Content</button>
                        </div>
                        <div id="subCategoryWrapper">
                            <div class="subCategoryBox toc-card   mb-3  ">
                                <div class="d-flex justify-content-end align-items-center mb-2">
                                    {{-- <h4 class="fw-bold">Table Of Content</h4> --}}
                                    <button type="button" class="remove-subcategory-btn" title="Remove Table of Content"
                                        style="display:none;">✕</button>
                                </div>
                                <div class="mt-2">
                                    <label class="fw-bold">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title[]" class="form-control" placeholder="Enter Title"
                                        required>
                                </div>
                                <div class="mt-2 descBox">
                                    <label class="fw-bold">Description<span class="text-danger">*</span></label>
                                    <textarea name="description[]" id="toc-description" class="form-control" rows="2" placeholder="Enter Description"></textarea>
                                </div>
                                {{-- <div class="mt-2 bulletsArea">
                                    <label class="fw-bold">Bullets</label>
                                    <div class="row bulletItem mb-2 align-items-center">
                                        <div class="col-10">
                                            <input type="text" name="bullets[0][]" class="form-control"
                                                placeholder="Enter bullet">
                                        </div>
                                        <div class="col-2 text-start mt-0">
                                            <button type="button" class="bullet-remove-btn removeBullet">✕</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-success addBullet ">+ Add
                                        Bullet</button>
                                </div> --}}
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" name="publish_is" value="1"
                                class="btn custom-theme-color   text-color px-4 ">Draft</button>
                            <button type="submit" name="publish_is" value="2"
                                class="btn custom-theme-color   text-color px-4 ">Publish</button>
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

        let index = 1; // for bullets array
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
        // $(".addSubCategory").click(function() {
        //     let firstBox = $(".subCategoryBox").first();
        //     let newBox = firstBox.clone();

        //     newBox.find("input, textarea").val("");
        //     newBox.find(".bulletItem").not(":first").remove();

        //     // Update data-index
        //     newBox.attr("data-index", index);
        //     // Update bullet input name
        //     newBox.find(".bulletItem input").attr("name", "bullets[" + index + "][]");

        //     // Show remove button for new block
        //     newBox.find(".remove-subcategory-btn").show();

        //     $("#subCategoryWrapper").append(newBox);
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

        // Remove Table of Content block
        $(document).on("click", ".remove-subcategory-btn", function() {
            let totalBoxes = $(".subCategoryBox").length;
            if (totalBoxes > 1) {
                $(this).closest(".subCategoryBox").remove();
            } else {
                alert("Cannot remove the first Table of Content block.");
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
                    <input type="text" name="bullets[` + parentIndex + `][]" class="form-control" placeholder="Enter bullet" >
                </div>
                <div class="col-2 text-start">
                    <button type="button" class="bullet-remove-btn removeBullet">✕</button>
                </div>
            </div>
        `;
            bulletBox.find(".addBullet").before(html);
        });
    </script>

@endsection
