@extends('admin.layouts.app')

@section('title', 'Edit Legal Assistance')

@section('content')

    <div class="content-wrapper d-flex justify-content-center ">
        <div class="col-12 col-xl-11 col-lg-9 col-md-10 m-auto">
            <div class="card shadow-sm border-0 rounded-4 my-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class=" m-0">Edit Legal Assistance</h4>
                        <a href="{{ route('admin.legal-assistance.index') }}" class="btn custom-theme-color   text-color">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <form action="{{ route('admin.legal-assistance.update', trim(base64_encode($data->id), '=')) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-4 border rounded shadow-sm mt-3 pb-3">
                            <div class="col-lg-7 col-md-12">
                                <div>
                                    <label class="form-label"> Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        value="{{ old('title', $data->title) }}" required>
                                </div>
                                <div class="mt-3">
                                    <label class="form-label"> Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" rows="2" required>{{ old('description', $data->description) }}</textarea>
                                </div>

                            </div>
                            <div class="col-lg-5 col-md-12">
                                <div class="mt-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image" id="imageInput"
                                        accept="image/png,image/jpeg,image/webp">
                                    @if ($data->image)
                                        <div class="mt-3"> <img id="previewImage" src="{{ $data->image }}"
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
                                class="btn custom-theme-color   text-color px-4 ">Update</button>
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


    </script>

@endsection
