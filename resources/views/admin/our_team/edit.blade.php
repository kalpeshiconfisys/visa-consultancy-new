@extends('admin.layouts.app') 
@section('title', 'Edit Visa Category')
@section('content')
    <div class="content-wrapper d-flex justify-content-center ">
        <div class="col-12 col-xl-11 col-lg-9 col-md-10 m-auto">
            <div class="card shadow-sm border-0 rounded-4 my-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold m-0">Edit Our Teams</h4>
                        <a href="{{ route('admin.our-teams.index') }}" class="btn btn-outline-danger">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <form action="{{ route('admin.our-teams.update', trim(base64_encode($data->id), '=')) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-4 border rounded shadow-sm mt-3 pb-3">
                            <div class="col-lg-7 col-md-12">
                                <div>
                                    <label class="form-label"> Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="title"
                                        value="{{ old('name', $data->name) }}" required>
                                </div>
                                <div class="mt-3">
                                    <label class="form-label"> Designation <span class="text-danger">*</span></label>
                                    <input class="form-control" name="designation" rows="2"  value="{{ old('designation', $data->designation) }}" required>
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
    </script>
@endsection
