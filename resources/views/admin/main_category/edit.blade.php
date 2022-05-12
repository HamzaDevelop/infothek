@extends('layouts.master')
@section('body')
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4>Update Main Category</h4>
            </div>
            <div class="card-body">
                <form class="form form-vertical" action="{{route('admin_update_main_category',$main_category->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Please Enter Main Category Name" value="{{$main_category->name}}" required>
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
