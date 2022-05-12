@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendors/quill/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/quill/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/quill/quill.snow.css')}}">
@endsection
@section('body')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Create Sub-Sub Category</h4>
            </div>
            <div class="card-body">
                <form class="form form-vertical" action="{{route('admin_store_sub_sub_category')}}" method="post" enctype="multipart/form-data" id="subForm">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Main Categories</label>
                                    <select name="main_category_id" class="mainCategory form-control form-select @error('main_category_id') is-invalid @enderror" required>
                                        <option value="">Please Select Main Category</option>
                                        @foreach($main_categories as $main_category)
                                            <option value="{{$main_category->id}}">{{$main_category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('main_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Sub Categories</label>
                                    <select name="sub_category_id" id="subCategory" class="form-control form-select @error('sub_category_id') is-invalid @enderror" required>

                                    </select>
                                    @error('sub_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Please Enter Sub Category Name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file_image">Upload Image</label>
                                    <input type="file" class="form-control @error('file_image') is-invalid @enderror" name="file_image" required>
                                    @error('file_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file_file">Upload File</label>
                                    <input type="file" class="form-control @error('file_file') is-invalid @enderror" name="file_file[]" multiple required>
                                    @error('file_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <div id="snow">

                                    </div>
                                    <input type="hidden" name="description">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary me-1 mb-1 submit">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/vendors/quill/quill.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-editor.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('change', '.mainCategory', function () {
                let main_category_id = $('select[name="main_category_id"]').find(':selected').val();
                let url = '{{route('admin_get_sub_categories_of_main_category')}}';
                let data = {
                    '_token': '{{csrf_token()}}',
                    'main_category_id': main_category_id
                }
                $.post(url, data, function (response) {
                    if (response.status === 'success') {
                        $('#subCategory').empty();
                        $.each(response.subCategories, function (key, val) {
                            let option = '<option value="' + val.id + '">' + val.name + '</option>'
                            $('#subCategory').append(option);
                        });
                    } else {
                        toastr.error(response.message);
                    }
                });
            });

            $(document).on('click', '.submit', function () {
                let description = $('.ql-editor').html();
                $('input[name="description"]').val(description);
                $('#subForm').submit();
            });
        });
    </script>
@endsection
