@extends('admin.layouts.app')

@section('title', 'Add Visa Category')

@section('content')

    <style>
        .bullet-remove-btn,
        .remove-subcategory-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: none;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .bullet-remove-btn {
            background: #dc3545;
            color: #fff;
        }

        .remove-subcategory-btn {
            background: #ffc107;
            color: #000;
        }
    </style>

    <div class="content-wrapper d-flex justify-content-center fw-bold">
        <div class="col-xl-10 col-lg-9 col-md-10 col-12">
            <div class="card shadow-sm rounded-4 my-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <h4>Add Visa Category</h4>
                        <a href="{{ url('admin/visa-category') }}" class="btn btn-outline-danger">← Back</a>
                    </div>
                    <form method="POST" action="{{ url('admin/visa-category/add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4 border rounded p-3">
                            <!-- LEFT -->
                            <div class="col-lg-7">
                                <label>Visa Title *</label>
                                <input type="text" name="main_title" class="form-control" required>

                                <label class="mt-3">Short Description *</label>
                                <textarea name="main_short_description" rows="2" class="form-control" required></textarea>

                                <label class="mt-3">Full Description *</label>
                                <textarea name="main_description" class="form-control editor" rows="6"></textarea>
                            </div>
                            <!-- RIGHT -->
                            <div class="col-lg-5">
                                <label>Featured Image *</label>
                                <input type="file" name="image" id="imageInput" class="form-control" required>
                                <img id="previewImage" src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                                    width="120" class="mt-2 border rounded">
                                <label class="mt-3">Category Logo *</label>
                                <input type="file" name="category_logo" id="logoInput" class="form-control" required>
                                <img id="logoPreview" src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                                    width="120" class="mt-2 border rounded">
                                <!-- BULLETS -->
                                <div class="mt-3 bulletsArea">
                                    <label>Bullets *</label>
                                    <div class="bulletItem row mb-2">
                                        <div class="col-10">
                                            <input type="text" name="category_bullets[]" class="form-control" required>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="bullet-remove-btn removeBullet">✕</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-success addBullet">+ Add Bullet</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- TABLE OF CONTENT -->
                        <div class="d-flex justify-content-between mt-4">
                            <h4>Table Of Content</h4>
                            <button type="button" class="btn btn-outline-primary addToc">+ Add</button>
                        </div>
                        <div id="tocWrapper">
                            <div class="tocBox border p-3 mt-3 rounded">
                                <button type="button" class="remove-subcategory-btn float-end"
                                    style="display:none;">✕</button>
                                <label>Title *</label>
                                <input type="text" name="title[]" class="form-control" required>
                                <label class="mt-2">Description</label>
                                <textarea name="description[]" class="form-control editor"></textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button name="publish_is" value="1" class="btn btn-outline-primary">Draft</button>
                            <button name="publish_is" value="2" class="btn btn-outline-success">Publish</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {

            // Summernote
            $('.editor').summernote({
                height: 250,
                toolbar: [
                    ['font', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol']],
                    ['insert', ['link', 'picture']],
                    ['link', ['view']],
                    ['view', ['codeview']],
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        if (files[0].size > 3 * 1024 * 1024) {
                            alert('Max 3MB allowed');
                            return;
                        }
                        if (files[0].size > 3 * 1024 * 1024) {
                            alert('Max 3MB allowed');
                            return;
                        }

                        let reader = new FileReader();
                        reader.onload = e => $(this).summernote('insertImage', e.target.result);
                        reader.readAsDataURL(files[0]);
                    }

                }
            });

            // Image Preview
            $('#imageInput').on('change', e => $('#previewImage').attr('src', URL.createObjectURL(e.target.files[0])));
            $('#logoInput').on('change', e => $('#logoPreview').attr('src', URL.createObjectURL(e.target.files[0])));

            // Add Bullet
            $(document).on('click', '.addBullet', function() {
                $('.bulletsArea').append(`
                    <div class="bulletItem row mb-2">
                        <div class="col-10"><input type="text" name="category_bullets[]" class="form-control"></div>
                        <div class="col-2"><button type="button" class="bullet-remove-btn removeBullet">✕</button></div>
                    </div>`
                );
            });
            $(document).on('click', '.removeBullet', function() {
                $(this).closest('.bulletItem').remove();
            });

            $('.addToc').click(function() {
                let box = $('.tocBox:first').clone();
                box.find('input,textarea').val('');
                box.find('.remove-subcategory-btn').show();
                $('#tocWrapper').append(box);
                box.find('.editor').summernote({
                    height: 200,
                    toolbar: [
                        ['font', ['bold', 'italic']],
                        ['para', ['ul', 'ol']]
                    ]
                });
            });

            $(document).on('click', '.remove-subcategory-btn', function() {
                $(this).closest('.tocBox').remove();
            });

        });
    </script>

@endsection
