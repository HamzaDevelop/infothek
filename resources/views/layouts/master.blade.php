<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoThek</title>
    @include('layouts.css')
    @yield('css')
</head>

<body>
<div id="app">
    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
        @include('layouts.sidebar')
    @endif
    <div id="main">
        <header class="mb-2" class='layout-navbar'>
            @include('layouts.navbar')
        </header>
        <div class="page-content">
            <div class="container">
                <div class="row">
                    @yield('body')
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.scripts')
@yield('scripts')
</body>

</html>
