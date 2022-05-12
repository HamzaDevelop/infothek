@extends('user.layouts.master')
@section('body')
    @include('user.partials.sub_categories',['sub_categories' => $main_category->subCategories])
    <div id="content" class="p-4 p-md-5 pt-5">
        <h4>{{$sub_sub_category->name}}:</h4>
        <div class="row">
            <div class="col-8">
                <p>{!! $sub_sub_category->description!!}</p>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <img class="img-thumbnail" src="{{asset('uploads/subSubCategoryImages/'.$sub_sub_category->file_image)}}" alt="">
                </div>
                <div>
                    <h6 class="ml-2">Attached Files</h6>
                    @foreach($sub_sub_category->subSubCategoryDocuments as $document)
                        <a class="form-control" href="{{asset('/uploads/subSubCategoryDocuments/'.$document->doc_name)}}" target="_blank">
                            <p style="color: #0f6674">{{$document->doc_name}}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
