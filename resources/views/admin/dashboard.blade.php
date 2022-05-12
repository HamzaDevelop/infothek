@extends('layouts.master')
@section('body')
    {{--main categories--}}
    <div class="col-6 col-lg-3 col-md-6">
        <a href="{{route('admin_get_main_categories')}}">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon green">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Main Categories</h6>
                            <h6 class="font-extrabold mb-0">{{count($main_categories)}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    {{--sub caegories--}}
    <div class="col-6 col-lg-3 col-md-6">
        <a href="{{route('admin_get_sub_categories')}}">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon red">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Sub Categories</h6>
                            <h6 class="font-extrabold mb-0">{{count($sub_categories)}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    {{--sub sub categories--}}
    <div class="col-6 col-lg-3 col-md-6">
        <a href="{{route('admin_get_sub_sub_categories')}}">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon purple">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Sub Sub Categories</h6>
                            <h6 class="font-extrabold mb-0">{{count($sub_sub_categories)}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endsection

