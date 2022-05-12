@extends('layouts.master')
@section('body')
    <div class="card">
        <div class="card-header">
            <h4>Sub Sub Categories</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Main Category</th>
                    <th>Sub Category</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @forelse($sub_sub_categories as $sub_sub_category)
                    <tr>
                        <td>{{$sub_sub_category->mainCategory->name}}</td>
                        <td>{{$sub_sub_category->subCategory->name}}</td>
                        <td>{{$sub_sub_category->name}}</td>
                        <td>
                            <img src="{{asset('uploads/subSubCategoryImages/'.$sub_sub_category->file_image)}}" alt="" height="100px">
                        </td>
                        <td>
                            <a class="btn btn-link" href="{{route('admin_get_sub_sub_category_details',$sub_sub_category->id)}}">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{route('admin_delete_sub_sub_category',$sub_sub_category->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link" onclick="return confirm('Are you sure you want to delete this sub-sub category')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No sub sub category found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{$sub_sub_categories->links()}}
        </div>
    </div>
@endsection
