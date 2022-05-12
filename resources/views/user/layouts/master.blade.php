<!doctype html>
<html lang="en">
<head>
    @include('user.layouts.css')
</head>
<body>
@include('user.layouts.navbar')
@include('user.main_categories')
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="row height d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <form action="{{route('search_sub_sub_category')}}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control border input-sm" name="search" placeholder="search" required autofocus>
                        <button type="submit" class="btn btn-sm btn-outline-dark"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>
<div class="container d-md-flex align-items-stretch">
    @yield('body')
</div>

@include('user.layouts.js')
</body>
</html>
