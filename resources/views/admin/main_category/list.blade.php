@extends('layouts.master')
@section('body')
    <div class="card">
        <div class="card-header">
            <h4>Main Categories</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @forelse($main_categories as $main_category)
                    <tr>
                        <td>{{$main_category->name}}</td>
                        <td>
                            <a class="btn btn-link" href="{{route('admin_edit_main_category',$main_category->id)}}">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{route('admin_delete_main_category',$main_category->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link" onclick="return confirm('Are you sure you want to delete this main category')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No main category found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{$main_categories->links()}}
        </div>
    </div>
@endsection()
