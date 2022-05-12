@extends('layouts.master')
@section('body')
    <div class="card">
        <div class="card-header">
            <h4>Sub Categories</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Main Category</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @forelse($sub_categories as $sub_category)
                    <tr>
                        <td>{{$sub_category->mainCategory->name}}</td>
                        <td>{{$sub_category->name}}</td>
                        <td>
                            <a class="btn btn-link" href="{{route('admin_edit_sub_category',$sub_category->id)}}">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{route('admin_delete_sub_category',$sub_category->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link" onclick="return confirm('Are you sure you want to delete this sub category')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No sub category found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{$sub_categories->links()}}
        </div>
    </div>
@endsection
