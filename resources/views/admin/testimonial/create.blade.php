@extends('admin.layouts.app')
@section('title', 'Add Testimonials')
@section('content')
    <div class="content-wrapper d-flex justify-content-center  ">
        <div class="col-12 col-xl-11 col-lg-9 col-md-10 m-auto">
            <div class="card shadow-sm rounded-4 my-4 main-category-card">
                <div class="card-body p-4 ">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold m-0">Add Our Teams</h4>
                        <a href="{{ url('admin/testimonials') }}" class="btn btn-outline-danger">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row g-4 border rounded shadow-sm mt-3 pb-3">
                            <div class="col-lg-7 col-md-12 ">
                                <div>
                                    <label class="form-label fw-bold">Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="title" required>
                                </div>
                                <div class="mt-3">
                                    <label class="form-label fw-bold">Description<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" rows="2" placeholder=""
                                        required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12">
                                <div class="mt-0">
                                    <label class="form-label fw-bold">Image <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="image" id="imageInput" accept="image/png,image/jpeg,image/webp" required>
                                    <div class="mt-3">
                                        <img id="previewImage" src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                                            class="img-fluid rounded shadow-sm border"
                                            style="width:120px;border-radius:8px;">
                                    </div>
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
    </script>
@endsection
