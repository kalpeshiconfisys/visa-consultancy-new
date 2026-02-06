@extends('admin.layouts.app')

@section('title', 'Add FAQ')

@section('content')

<div class="content-wrapper d-flex justify-content-center">
    <div class="col-12 col-xl-11 col-lg-9 col-md-10 m-auto">
        <div class="card shadow-sm rounded-4 my-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="fw-bold">FAQ</h4>
                    <button type="button" id="addFaq" class="btn btn-primary">+ Add More</button>
                </div>
                <form action="{{ url('admin/faq-submit') }}" method="POST">
                    @csrf
                    <div id="faq-wrapper">
                        <!-- ONE FAQ BLOCK -->
                        <div class="faq-item border rounded p-3 mb-3">
                            <div class="mb-2">
                                <label class="fw-bold">Question</label>
                                <input type="text" name="question[]" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label class="fw-bold">Answer</label>
                                <textarea name="answer[]" class="form-control summernote" rows="4" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Save FAQ</button>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- JS --}}
<script>
$(document).ready(function(){

    // function initEditor() {
    //     $('.summernote').summernote({
    //         height: 150,
    //         toolbar: [
    //             ['font', ['bold','underline','italic']],
    //             ['para', ['ul','ol']],
    //             ['insert', ['link']],
    //             ['view', ['codeview']]
    //         ]
    //     });
    // }

    // initEditor();

    // ADD NEW FAQ
    $('#addFaq').click(function(){
        let html = `
        <div class="faq-item border rounded p-3 mb-3">
            <button type="button" class="btn btn-danger removeFaq  d-flex justify-content-end align-items-center">✕</button>
            <div class="mb-2">
                <label class="fw-bold">Question</label>
                <input type="text" name="question[]" class="form-control" required>
            </div>

            <div class="mb-2">
                <label class="fw-bold">Answer</label>
                <textarea name="answer[]" class="form-control summernote" rows="4" required></textarea>
            </div>


        </div>
        `;
        $('#faq-wrapper').append(html);
        initEditor();
    });

    // REMOVE FAQ
    $(document).on('click','.removeFaq',function(){
        $(this).closest('.faq-item').remove();
    });

});
</script>

@endsection
