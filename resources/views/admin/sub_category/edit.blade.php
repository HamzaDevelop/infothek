@extends('layouts.master')
@section('body')
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4>Update Sub Category</h4>
            </div>
            <div class="card-body">
                <form class="form form-vertical" action="{{route('admin_update_sub_category',$sub_category->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Main Categories</label>
                                    <select name="main_category_id" class="form-control form-select @error('main_category_id') is-invalid @enderror" required>
                                        <option value="">Please Select Main Category</option>
                                        @foreach($main_categories as $main_category)
                                            <option value="{{$main_category->id}}" {{$main_category->id == $sub_category->main_category_id ? 'selected' : ''}}>{{$main_category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('main_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Please Enter Sub Category Name" value="{{$sub_category->name}}" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
