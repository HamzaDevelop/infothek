@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendors/quill/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/quill/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/quill/quill.snow.css')}}">
@endsection
@section('body')
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h4>Detail Of Sub-Sub Category</h4>
            </div>
            <div class="card-body">
                <form class="form form-vertical" action="{{route('admin_update_sub_sub_category',$sub_sub_category->id)}}" method="post" enctype="multipart/form-data" id="subForm">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="name">Main Category</label>
                                        <select name="main_category_id" class="mainCategory form-control form-select @error('main_category_id') is-invalid @enderror" required>
                                            <option value="">Please Select Main Category</option>
                                            @foreach($main_categories as $main_category)
                                                <option value="{{$main_category->id}}" {{$sub_sub_category->main_category_id == $main_category->id ? 'selected' : ''}}>{{$main_category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('main_category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Sub Category</label>
                                    <select name="sub_category_id" id="subCategory" class="form-control form-select @error('sub_category_id') is-invalid @enderror" required>
                                        <option value="">Please Select Sub Category</option>
                                        @foreach($sub_categories as $sub_category)
                                            <option value="{{$sub_category->id}}" {{$sub_sub_category->sub_category_id == $sub_category->id ? 'selected' : ''}}>{{$sub_category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('sub_category_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$sub_sub_category->name}}" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Image</label><br>
                                    <img src="{{asset('uploads/subSubCategoryImages/'.$sub_sub_category->file_image)}}" alt="" height="150px">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="file_image">Upload New Image</label>
                                    <input type="file" class="form-control @error('file_image') is-invalid @enderror" name="file_image" required>
                                    @error('file_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="file_file">Old Files</label>
                                    @foreach($sub_sub_category->subSubCategoryDocuments as $document)
                                        <div class="col-4 oldDocuments" id="doc-{{$document->id}}">
                                            <button type="button" class="btn btn-link remove" id="{{$document->id}}" style="float: right;">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                            <a class="form-control" href="{{asset('/uploads/subSubCategoryDocuments/'.$document->doc_name)}}" target="_blank">
                                                <p>{{$document->doc_name}}</p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file_file">Upload More Files</label>
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
                                        {!! $sub_sub_category->description !!}
                                    </div>
{{--                                    <div class="form-control"></div>--}}
                                </div>
                                <input type="hidden" name="description">
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <a href="#" type="button" class="btn btn-primary me-1 mb-1 submit">Update</a>
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

            $(document).on('click','.remove',function (){
                let docId = this.id;
                let url = '{{route('admin_delete_sub_sub_category_document')}}';
                let data = {
                    '_token' : '{{csrf_token()}}',
                    'docId' : docId
                }
                $.post(url,data,function (response){
                    if(response.status === 'success'){
                        toastr.success(response.message,'Success');
                        $('#doc-'+docId).remove();
                        if (isEmpty($('.oldDocuments'))) {
                            $('input[name="documents[]"]').prop('required',true);
                        }
                    }else{
                        toastr.error(response.message,'Error');
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
