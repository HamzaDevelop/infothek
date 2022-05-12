@extends('user.layouts.master')
@section('body')
    @include('user.partials.sub_categories',['sub_categories' => $main_category->subCategories])
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4 text-center">Please Select Sub Sub Category To View Details</h2>
    </div>
@endsection
