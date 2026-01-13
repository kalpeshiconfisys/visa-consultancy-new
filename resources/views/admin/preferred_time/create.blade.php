@extends('admin.layouts.app')

@section('title', 'Add Visa Category')

@section('content')


    <div class="content-wrapper d-flex justify-content-center fw-bold ">
        <div class="col-12 col-xl-10 col-lg-9 col-md-10 m-auto">
            <div class="card shadow-sm rounded-4 my-4 main-category-card">
                <div class="card-body p-4 ">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold m-0">Add Appointment Time</h4>
                        <a href="{{ route('admin.preferred-time.index') }}" class="btn btn-outline-danger">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <form action="{{ route('admin.preferred-time.store') }}" method="POST">
                        @csrf

                        <div class="row g-4   rounded   mt-3 pb-3">
                            <div class="col-lg-7 col-md-12 ">
                                <div>
                                    <label class="form-label fw-bold">Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" name="publish_is" value="2"
                                class="btn btn-outline-success px-4 ">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- CKEditor -->
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // CKEDITOR
            // ClassicEditor
            //     .create(document.querySelector('#editor'))
            //     .catch(error => console.error(error));

            // IMAGE PREVIEW
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
            $('#editor').summernote({
                height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'italic']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        var maxFileSize = 3 * 1024 * 1024;

                        for (var i = 0; i < files.length; i++) {
                            var file = files[i];

                            if (file.size <= maxFileSize) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    $('#post_content').summernote('insertImage', e.target.result);
                                };
                                reader.readAsDataURL(file);
                            } else {
                                alert('Image size exceeds the 3 MB limit.');
                            }
                        }
                    }
                }
            });
        });



        // bahar ni side na bulllets

        let index = 1;

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



        // table of content jquery

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
        $(".addSubCategory").click(function() {
            let firstBox = $(".subCategoryBox").first();
            let newBox = firstBox.clone();

            newBox.find("input, textarea").val("");
            newBox.find(".bulletItem").not(":first").remove();

            // Update data-index
            newBox.attr("data-index", index);
            // Update bullet input name
            newBox.find(".bulletItem input").attr("name", "bullets[" + index + "][]");

            // Show remove button for new block
            newBox.find(".remove-subcategory-btn").show();

            $("#subCategoryWrapper").append(newBox);
            index++;
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
